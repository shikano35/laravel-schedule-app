@extends('layouts.app')

@section('content')
<div class="container">
    <h1>スケジュール登録</h1>
    <form action="{{ route('schedules.confirm') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="begin">開始日時</label>
            <input type="datetime-local" name="begin" class="form-control" value="{{ old('begin', $scheduleData['begin'] ?? '') }}" required onclick="this.showPicker()">
            @error('begin')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="end">終了日時</label>
            <input type="datetime-local" name="end" class="form-control" value="{{ old('end', $scheduleData['end'] ?? '') }}" required onclick="this.showPicker()">
            @error('end')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="place">場所</label>
            <input type="text" name="place" class="form-control" value="{{ old('place', $scheduleData['place'] ?? '') }}" required>
        </div>
        <div class="form-group">
            <label for="content">内容</label>
            <textarea name="content" class="form-control" required>{{ old('content', $scheduleData['content'] ?? '') }}</textarea>
        </div>
        <br>
        <div class="row mb-0 justify-content-center">
            <div class="col-md-8 text-center">
                <button type="submit" class="btn btn-primary">登録</button>
                <a href="{{ route('schedules.index') }}" class="btn btn-secondary" style="margin-left: 50px;">戻る</a>
            </div>
        </div>
    </form>
</div>
@endsection