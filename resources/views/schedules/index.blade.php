@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h2>スケジュール一覧</h2>
        <a href="{{ route('schedules.create') }}" class="btn btn-primary">新規登録</a>
    </div>

    <div class="d-flex justify-content-between mb-3">
    <form method="GET" action="{{ route('schedules.index') }}">
        <input type="hidden" name="filter" value="{{ $filter }}">
        <input type="hidden" name="date" value="{{ $filter === 'Day' ? $currentDate->copy()->subDay()->toDateString() : ($filter === 'Month' ? $currentDate->copy()->subMonth()->toDateString() : $currentDate->copy()->subWeek()->toDateString()) }}">
        @if ($filter !== 'ALL')
            <button type="submit" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
            </button>
        @endif
    </form>
    <form method="GET" action="{{ route('schedules.index') }}">
        <input type="hidden" name="filter" value="{{ $filter }}">
        <input type="hidden" name="date" value="{{ $filter === 'Day' ? $currentDate->copy()->addDay()->toDateString() : ($filter === 'Month' ? $currentDate->copy()->addMonth()->toDateString() : $currentDate->copy()->addWeek()->toDateString()) }}">
        @if ($filter !== 'ALL')
            <button type="submit" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
            </button>
        @endif
    </form>
</div>

    <table class="table">
        <thead>
            <tr>
                <th>開始日時</th>
                <th>終了日時</th>
                <th>場所</th>
                <th>内容</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
            <tr>
                <td>{{ $schedule->begin }}</td>
                <td>{{ $schedule->end }}</td>
                <td>{{ $schedule->place }}</td>
                <td>{{ $schedule->content }}</td>
                <td>
                    <a href="{{ route('schedules.edit', $schedule) }}" class="btn btn-light">編集</a>
                    <form action="{{ route('schedules.confirmDelete', $schedule) }}" method="GET" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-dark">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection