@extends('users.admin.layout')
@section('title', 'Edit Student Timetable')
@section('content')
<div class="container mt-4">
    <h2>Edit Student Timetable</h2>
    <form action="{{ route('updateStudentTimetable', $timetableEntry->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="grade_id" class="form-label">Grade</label>
            <select name="grade_id" id="grade_id" class="form-select" required>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ $timetableEntry->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="subject_id" class="form-label">Subject</label>
            <select name="subject_id" id="subject_id" class="form-select" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $timetableEntry->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="time_slot_id" class="form-label">Time Slot</label>
            <select name="time_slot_id" id="time_slot_id" class="form-select" required>
                @foreach($timeSlots as $timeSlot)
                    <option value="{{ $timeSlot->id }}" {{ $timetableEntry->time_slot_id == $timeSlot->id ? 'selected' : '' }}>{{ $timeSlot->start_time }} - {{ $timeSlot->end_time }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Timetable</button>
    </form>
</div>
@endsection
