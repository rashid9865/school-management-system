@extends('users.admin.layout')
@section('title', 'Edit Time Management')
@section('content')
<div class="container mt-4">
    <h2>Edit Time Management</h2>
    <form action="{{ route('time-management.update', $timeManagements->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="day" class="form-label">Day</label>
            <input type="text" name="day" id="day" class="form-control" value="{{ $timeManagements->day }}" required>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $timeManagements->start_time }}" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $timeManagements->end_time }}" required>
        </div>

        <div class="mb-3">
            <label for="period_minutes" class="form-label">Period Duration (minutes)</label>
            <input type="number" name="period_minutes" id="period_minutes" class="form-control" value="{{ $timeManagements->period_minutes ?? 60 }}" min="1" required>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $timeManagements->date }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Time Management</button>
        <a href="{{ route('time-management.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

