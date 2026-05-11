@extends('users.teacher.layout')

@section('title')
Dashboard
@endsection

@section('css')
<link href="{{ asset('css/teacher/dashboard.css') }}" rel="stylesheet" />
@endsection

@section('content')
<section class="dashboard-hero">
    <div class="hero-text-block">
        <p class="eyebrow">Teacher overview</p>
        <h2>Welcome back, {{ $user->name ?? 'Teacher' }}</h2>
        <p class="hero-description">Here is a quick summary of your classes, assignments, and student progress.</p>
    </div>
    <a href="{{ route('teacher.announcements') }}" class="hero-button">Post announcement</a>
</section>

<div class="dashboard-stats">
    <article class="stat-card">
        <p class="stat-label">Subjects assigned</p>
        <h3>{{ $subjects->count() }}</h3>
        <span class="stat-note">{{ $subjects->count() }} class{{ $subjects->count() != 1 ? 'es' : '' }}</span>
    </article>
    <article class="stat-card">
        <p class="stat-label">Students</p>
        <h3>{{ $students->count() }}</h3>
        <span class="stat-note">Total enrolled</span>
    </article>
    <article class="stat-card">
        <p class="stat-label">Assignments</p>
        <h3>{{ $assignments->count() }}</h3>
        <span class="stat-note">Created by you</span>
    </article>
    <article class="stat-card">
        <p class="stat-label">Exams</p>
        <h3>{{ $exams->count() }}</h3>
        <span class="stat-note">Upcoming</span>
    </article>
</div>

<div class="dashboard-table-card">
    <div class="table-card-header">
        <div>
            <p class="eyebrow">Your subjects</p>
            <h3>Assigned courses and classes</h3>
        </div>
        <span class="badge">{{ $subjects->count() }} active</span>
    </div>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Students</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subjects as $subject)
                    <tr>
                        <td>{{ $subject->name ?? 'N/A' }}</td>
                        <td>{{ $subject->students->count() ?? 0 }}</td>
                        <td><span class="status status-ok">Active</span></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No subjects assigned yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection