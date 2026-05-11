@extends('users.teacher.layout')

@section('title')
Teacher profile
@endsection
@section('css')
<link href="{{ asset('css/teacher/profile.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="teacher-profile-container">
    <div class="profile-header">
        <div class="profile-image-section">
            <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/default-teacher.png') }}" class="teacher-profile-image" alt="Teacher Image" />
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
        </div>
    </div>
    <div class="profile-details">
        <div class="detail-card personal-details">
            <h3>Personal Details</h3>
            <div class="detail-item">
                <strong>Gender:</strong> {{ $teacher->gender ?? 'Not specified' }}
            </div>
            <div class="detail-item">
                <strong>Birth Date:</strong> {{ $teacher->birth_date ? \Carbon\Carbon::parse($teacher->birth_date)->format('d M Y') : 'Not specified' }}
            </div>
            <div class="detail-item">
                <strong>Address:</strong> {{ $teacher->address ?? 'Not specified' }}
            </div>
            <div class="detail-item">
                <strong>Phone:</strong> {{ $teacher->phone ?? 'Not specified' }}
            </div>
        </div>
        <div class="detail-card classroom-details">
            <h3>Professional Details</h3>
            <div class="detail-item">
                <strong>Qualification:</strong> {{ $teacher->qualification ?? 'Not specified' }}
            </div>
            <div class="detail-item">
                <strong>Date of Hire:</strong> {{ $teacher->hire_date ? \Carbon\Carbon::parse($teacher->hire_date)->format('d M Y') : 'Not specified' }}
            </div>
            <div class="detail-item">
                <strong>Status:</strong> {{ $teacher->status ?? 'Active' }}
            </div>
        </div>
    </div>
    <div class="profile-actions">
        <a href="{{ route('teacher.edit', $teacher->id) }}" class="teacher-profile-btn">Update Profile</a>
    </div>
</div>
@endsection