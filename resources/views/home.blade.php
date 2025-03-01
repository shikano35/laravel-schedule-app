@extends('layouts.app')

@section('content')
<div class="container">
    <h1>スケジュール一覧</h1>
    @if ($schedules->isEmpty())
        <p>スケジュールはありません。</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>開始日時</th>
                    <th>終了日時</th>
                    <th>場所</th>
                    <th>内容</th>
                </tr>
            </thead>
            <tbody>
                @foreach($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->begin }}</td>
                    <td>{{ $schedule->end }}</td>
                    <td>{{ $schedule->place }}</td>
                    <td>{{ $schedule->content }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
