@extends('users.admin.layout')

@section('title')
Mark Attendance
@endsection

@section('csrf_token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
<style>
    .admin-hero {
        padding: 28px 30px;
        background: rgba(14, 165, 233, 0.08);
        border-radius: 28px;
        margin-bottom: 24px;
    }

    .form-container {
        max-width: 760px;
        margin: 0 auto 30px;
        padding: 28px;
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-radius: 28px;
        box-shadow: 0 20px 45px rgba(15, 23, 42, 0.06);
    }

    .form-container form {
        display: grid;
        gap: 20px;
    }

    .form-group {
        display: grid;
        gap: 10px;
    }

    .form-group label {
        font-weight: 700;
        color: #0f172a;
    }

    .form-group select,
    .form-group input {
        width: 100%;
        min-height: 48px;
        border-radius: 16px;
        padding: 12px 16px;
        border: 1px solid #cbd5e1;
        background: #f8fbff;
        color: #0f172a;
        font-size: 0.98rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .form-group select:focus,
    .form-group input:focus {
        outline: none;
        border-color: #0ea5e9;
        box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.16);
    }

    .button-primary {
        width: fit-content;
        padding: 14px 28px;
        border-radius: 16px;
        font-size: 1rem;
    }

    .alert {
        max-width: 760px;
        margin: 0 auto;
        padding: 18px 22px;
        border-radius: 18px;
        background: #ecfdf5;
        border: 1px solid #bbf7d0;
        color: #166534;
        box-shadow: 0 12px 30px rgba(16, 185, 129, 0.1);
    }

    @media (max-width: 720px) {
        .admin-hero,
        .form-container,
        .alert {
            padding: 20px;
            margin-left: 12px;
            margin-right: 12px;
            border-radius: 20px;
        }
    }
</style>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
<section class="admin-hero">
    <div>
        <p class="eyebrow">Attendance Management</p>
        <h1>Mark Student Attendance</h1>
        <p class="hero-text">Record daily attendance for students.</p>
    </div>
</section>

<div class="form-container">
    <form action="{{ route('admin.attendance.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student_id">Select Student</label>
            <select name="student_id" id="student_id" required>
                <option value="">Choose a student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->user->name ?? $student->name }} ({{ $student->user->email ?? $student->email }})</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
            </select>
        </div>

        <button type="submit" class="button button-primary">Mark Attendance</button>
    </form>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection