@extends('layouts.app')

@section('content')
<div class="container">
    <h1>スケジュール登録確認</h1>
    <p>以下の内容で登録しますか？</p>
    <form action="{{ route('schedules.store') }}" method="POST">
        @csrf
        <input type="hidden" name="begin" value="{{ $schedule->begin }}">
        <input type="hidden" name="end" value="{{ $schedule->end }}">
        <input type="hidden" name="place" value="{{ $schedule->place }}">
        <input type="hidden" name="content" value="{{ $schedule->content }}">
        
        <div class="form-group">
            <label for="begin">開始日時</label>
            <input type="datetime-local" name="begin_display" class="form-control" value="{{ $schedule->begin->format('Y-m-d\TH:i') }}" disabled required>
        </div>
        <div class="form-group">
            <label for="end">終了日時</label>
            <input type="datetime-local" name="end_display" class="form-control" value="{{ $schedule->end->format('Y-m-d\TH:i') }}" disabled required>
        </div>
        <div class="form-group">
            <label for="place">場所</label>
            <input type="text" name="place_display" class="form-control" value="{{ $schedule->place }}" disabled required>
        </div>
        <div class="form-group">
            <label for="content">内容</label>
            <textarea name="content_display" class="form-control" disabled required>{{ $schedule->content }}</textarea>
        </div>
        
        <br>
        <div class="row mb-0 justify-content-center">
            <div class="col-md-8 text-center">
                <button type="submit" class="btn btn-primary">登録する</button>
                <a href="{{ route('schedules.create', ['from_confirm' => true]) }}" class="btn btn-secondary" style="margin-left: 50px;">戻る</a>
            </div>
        </div>
    </form>
</div>
@endsection