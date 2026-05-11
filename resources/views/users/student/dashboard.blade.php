@extends('users.student.layout')

@section('title')
Student Dashboard
@endsection

@section('css')
<link href="{{ asset('css/student/dashboard.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="student-hero">
    <div>
        <p class="eyebrow">Student dashboard</p>
        <h1>Welcome back, {{ $user->name ?? 'Student' }}</h1>
        <p class="hero-description">Track your attendance, upcoming lessons, and most recent announcements from one clean dashboard.</p>
    </div>
</section>

<div class="student-stats-grid">
    <article class="student-card">
        <p class="sta-label">Assignments</p>
        <h2>{{ $assignmentCount }} total</h2>
        <span class="stat-note">Keep your assignments up to date</span>
    </article>

    <article class="student-card">
        <p class="stat-label">Class fee amount</p>
        <h2>{{ $classFeeAmount ? number_format($classFeeAmount, 2) : 'N/A' }}</h2>
        <span class="stat-note">{{ $feeStructureLabel ?? 'Admin fee structure not set' }}</span>
    </article>

    <article class="student-card">
        <p class="stat-label">Next exam</p>
        <h2>{{ $nextExam->name ?? 'No upcoming exam' }}</h2>
        <span class="stat-note">{{ optional($nextExam)->exam_date_time?->format('d M Y H:i') ?? 'No exam scheduled' }}</span>
    </article>
</div>

<div class="student-links-card">
    <div class="panel-header">
        <div>
            <p class="eyebrow">Enrolled Subjects</p>
            <h2>Subjects assigned to your class</h2>
        </div>
    </div>

    @if($student->grade && $student->grade->subjects->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #f8fafc; border-bottom: 1px solid #e2e8f0;">
                        <th style="padding: 1rem; text-align: left; color: #4b5563; font-weight: 600;">Subject</th>
                        <th style="padding: 1rem; text-align: left; color: #4b5563; font-weight: 600;">Teacher</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student->grade->subjects as $subject)
                        <tr style="border-bottom: 1px solid #e2e8f0;">
                            <td style="padding: 1rem;">{{ $subject->name }}</td>
                            <td style="padding: 1rem;">
                                @if($subject->teachers->count() > 0)
                                    {{ $subject->teachers->pluck('user.name')->join(', ') }}
                                @else
                                    <span style="color: #9ca3af;">Not assigned</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="padding: 2rem; text-align: center; color: #9ca3af;">
            <p>No subjects assigned to your class yet.</p>
        </div>
    @endif
</div>

<div class="student-links-card">
    <div class="panel-header">
        <div>
            <p class="eyebrow">Quick links</p>
            <h2>Explore your most important sections</h2>
        </div>
    </div>

    <div class="quick-links">
        <a href="{{ route('student.subjects') }}" class="quick-link">Subjects</a>
        <a href="{{ route('student.attendance') }}" class="quick-link">Attendance</a>
        <a href="{{ route('student.assignments') }}" class="quick-link">Assignments</a>
        <a href="{{ route('student.results') }}" class="quick-link">Results</a>
        <a href="{{ route('student.timetable') }}" class="quick-link">Timetable</a>
        <a href="{{ route('student.messages') }}" class="quick-link">Messages</a>
    </div>
</div>
@endsection