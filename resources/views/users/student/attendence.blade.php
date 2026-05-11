@extends('users.student.layout')

@section('title')
Student Attendence
@endsection

@section('css')
<link href="{{ asset('css/student/attendence.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="student-attendence-container">
    <header class="student-attendence-header">
        <div>
            <h1>Attendance overview</h1>
            <p class="student-attendence-subtitle">Track attendance trends and view your recent daily status.</p>
        </div>
    </header>

    <section class="student-attendence-summary">
        <article class="attendance-card attendance-card-total">
            <span class="attendance-card-label">Total records</span>
            <strong>{{ $attendances->count() }}</strong>
        </article>
        <article class="attendance-card attendance-card-present">
            <span class="attendance-card-label">Present</span>
            <strong>{{ $attendances->where('status', 'present')->count() }}</strong>
        </article>
        <article class="attendance-card attendance-card-absent">
            <span class="attendance-card-label">Absent</span>
            <strong>{{ $attendances->where('status', 'absent')->count() }}</strong>
        </article>
        <article class="attendance-card attendance-card-leave">
            <span class="attendance-card-label">Leave</span>
            <strong>{{ $attendances->where('status', 'leave')->count() }}</strong>
        </article>
    </section>

    <section class="student-attendence-table-card">
        <div class="attendance-table-header">
            <h2>Recent attendance</h2>
            <p>Latest entries are shown first for quick review.</p>
        </div>

        <div class="attendance-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->date ? \Carbon\Carbon::parse($attendance->date)->format('d M Y') : 'N/A' }}</td>
                            <td><span class="attendance-status attendance-status-{{ strtolower($attendance->status) }}">{{ ucfirst($attendance->status) }}</span></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No attendance records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection