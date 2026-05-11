@extends('users.teacher.layout')

@section('title')
Attendance
@endsection

@section('css')
<link href="{{ asset('css/teacher/attendence.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="attendence-container">
    <h2>Student Attendance</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="attendance-form-card">
        <h3>Mark attendance for students</h3>
        <form action="{{ route('teacher.attendance.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="subject_id">Subject</label>
                    <select id="subject_id" name="subject_id" required>
                        <option value="">Select subject</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                        @endforeach
                    </select>
                    @error('subject_id') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" value="{{ old('date', now()->format('Y-m-d')) }}" required />
                    @error('date') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            @if($students->count() > 0)
                <div class="attendance-table-wrap">
                    <table class="attendance-table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $student)
                                <tr>
                                    <td>{{ $student->name ?? $student->user->name ?? 'N/A' }}</td>
                                    <td>
                                        <select name="statuses[{{ $student->id }}]">
                                            <option value="present">Present</option>
                                            <option value="absent">Absent</option>
                                            <option value="leave">Leave</option>
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn-submit">Save Attendance</button>
            @else
                <p>No students are assigned to your subjects yet.</p>
            @endif
        </form>
    </section>

    <section class="attendance-history-card">
        <h3>Recorded attendance</h3>
        @if($attendances->count() > 0)
            <table class="attendance-table">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Subject</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->student->name ?? $attendance->student->user->name ?? 'N/A' }}</td>
                            <td>{{ $attendance->date ? \Carbon\Carbon::parse($attendance->date)->format('d M Y') : 'N/A' }}</td>
                            <td>{{ ucfirst($attendance->status) }}</td>
                            <td>{{ $attendance->subject ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No attendance records found.</p>
        @endif
    </section>
</div>
@endsection