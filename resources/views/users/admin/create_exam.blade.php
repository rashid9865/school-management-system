@extends('users.admin.layout')

@section('title')
Create Exam
@endsection

@section('csrf_token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/exam_create.css') }}">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
<section class="admin-hero">
    <div>
        <p class="eyebrow">Exam Management</p>
        <h1>Create New Exam</h1>
        <p class="hero-text">Schedule exams for subjects.</p>
    </div>
</section>

<div class="form-container">
    <form action="{{ route('admin.exams.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Exam Name</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="subject_id">Select Subject</label>
            <select name="subject_id" id="subject_id" required>
                <option value="">Choose a subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="date">Exam Date</label>
            <input type="date" name="date" id="date" required>
        </div>

        <button type="submit" class="button button-primary">Create Exam</button>
    </form>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@endsection