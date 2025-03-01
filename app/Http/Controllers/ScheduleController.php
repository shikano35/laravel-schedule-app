<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'ALL');
        $date = $request->input('date', now()->toDateString());
        $currentDate = \Carbon\Carbon::parse($date);
        $startOfWeek = $currentDate->copy()->startOfWeek();
        $endOfWeek = $currentDate->copy()->endOfWeek();

        $schedules = Schedule::where('user_id', auth()->id());

        switch ($filter) {
            case 'Day':
                $schedules->whereDate('begin', $currentDate);
                break;
            case 'Week':
                $schedules->whereBetween('begin', [$startOfWeek, $endOfWeek]);
                break;
            case 'Month':
                $startOfMonth = $currentDate->copy()->startOfMonth();
                $endOfMonth = $currentDate->copy()->endOfMonth();
                $schedules->whereBetween('begin', [$startOfMonth, $endOfMonth]);
                break;
            case 'ALL':
            default:
                break;
        }

        $schedules = $schedules->get();
        return view('schedules.index', compact('schedules', 'filter', 'startOfWeek', 'endOfWeek', 'currentDate'));
    }

    public function create(Request $request)
    {
        if (!$request->has('from_confirm')) {
            $request->session()->forget('schedule_data');
        }

        $scheduleData = session('schedule_data', []);

        return view('schedules.create', compact('scheduleData'));
    }

    public function store(Request $request)
    {
        $schedule = new Schedule($request->all());
        $schedule->user_id = auth()->id();
        $schedule->save();

        $request->session()->forget('schedule_data');

        return redirect()->route('schedules.index')->with('success', 'スケジュールが正常に登録されました。');
    }

    public function confirm(Request $request)
    {
        $request->session()->put('schedule_data', $request->all());

        $request->validate([
            'begin' => 'required|date',
            'end' => 'required|date|after:begin',
            'place' => 'required|string',
            'content' => 'required|string',
        ], [
            'end.after' => '終了日時は開始日時の後でなければなりません。',
        ]);

        $schedule = new Schedule($request->all());

        return view('schedules.confirm', compact('schedule'));
    }

    public function edit(Schedule $schedule)
    {
        return view('schedules.edit', compact('schedule'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'begin' => 'required|date',
            'end' => 'required|date|after:begin',
            'place' => 'required|string',
            'content' => 'required|string',
        ], [
            'end.after' => '終了日時は開始日時の後でなければなりません。',
        ]);

        $schedule->update($request->all());

        return redirect()->route('schedules.index');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index');
    }

    public function confirmDelete(Schedule $schedule)
    {
        return view('schedules.confirm_delete', compact('schedule'));
    }
    
}