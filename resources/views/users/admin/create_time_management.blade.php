@extends('users.admin.layout');

@section('content')
<div class="container mt-4">
    <h1>Create Time Management Entry</h1>

    <form action="{{ route('time-management.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>
        <div class="mb-3">
            <label for="day" class="form-label">Day</label>
            <input type="text" class="form-control" id="day" name="day" required>
        </div>  
        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" class="form-control" id="start_time" name="start_time" required> 
        </div>
        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" class="form-control" id="end_time" name="end_time" required>     
        </div>
        <div class="mb-3">
            <label for="period_minutes" class="form-label">Period Duration (minutes)</label>
            <input type="number" class="form-control" id="period_minutes" name="period_minutes" min="1" value="60" required>
            <div class="form-text">How many minutes should each period last?</div>
        </div>
        <button type="submit" class="btn btn-primary">Create</button>       
    </form>
</div>
@endsection