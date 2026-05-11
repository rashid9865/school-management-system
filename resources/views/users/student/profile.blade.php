@extends('users.student.layout')

@section('title')
Student Profile
@endsection

@section('css')
<link href="{{ asset('css/student/profile.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="student-profile-container">
    <section class="student-profile-card student-profile-header">
        <div class="student-profile-avatar">
            <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/student-placeholder.png') }}" class="student-profile-image" alt="Student photo" />
        </div>
        <div class="student-profile-summary">
            <h2>{{ $student->name }}</h2>
            <p class="student-profile-email">{{ $user->email }}</p>
            <p class="student-profile-tag">{{ $student->grade->name ?? 'Grade not assigned' }} • Section {{ $student->section->name ?? 'N/A' }}</p>
        </div>
    </section>

    <section class="student-profile-card student-profile-details">
        <div class="student-profile-detail-group">
            <h3>Personal details</h3>
            <div class="student-profile-detail-row"><span>Roll No</span><strong>{{ $student->roll_no ?? 'N/A' }}</strong></div>
            <div class="student-profile-detail-row"><span>Age</span><strong>{{ $student->age ?? 'N/A' }}</strong></div>
            <div class="student-profile-detail-row"><span>Gender</span><strong>{{ ucfirst($student->gender ?? 'N/A') }}</strong></div>
            <div class="student-profile-detail-row student-profile-detail-long"><span>Address</span><strong>{{ $student->address ?? 'N/A' }}</strong></div>
        </div>

        <div class="student-profile-detail-group">
            <h3>Classroom details</h3>
            <div class="student-profile-detail-row"><span>Class</span><strong>{{ $student->grade->name ?? 'N/A' }}</strong></div>
            <div class="student-profile-detail-row"><span>Section</span><strong>{{ $student->section->name ?? 'N/A' }}</strong></div>
            <div class="student-profile-detail-row"><span>Status</span><strong>{{ $student->status ?? 'Active' }}</strong></div>
            <div class="student-profile-detail-row"><span>Registered</span><strong>{{ optional($student->created_at)->format('M d, Y') ?? 'N/A' }}</strong></div>
        </div>
    </section>

    <div class="student-profile-actions">
        <a href="{{ route('student.edit', $student->id) }}" class="student-profile-btn">Update Profile</a>
    </div>
</div>
@endsection