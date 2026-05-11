@extends('users.teacher.layout')
@section('title')
My Classes
@endsection
@section('css')
<link href="{{ asset('css/teacher/teacherclasses.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="teacherclasses-container">
    <h2>My Classes</h2>
    @if($subjects->count() > 0)
        <div class="subjects-grid">
            @foreach($subjects as $subject)
                <div class="subject-card">
                    <h3>{{ $subject->name }}</h3>
                    <p><strong>Code:</strong> {{ $subject->code ?? 'N/A' }}</p>
                    <p><strong>Description:</strong> {{ $subject->description ?? 'No description' }}</p>
                    <p><strong>Status:</strong> {{ $subject->status ?? 'Active' }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p>No subjects assigned yet.</p>
    @endif
</div>
@endsection