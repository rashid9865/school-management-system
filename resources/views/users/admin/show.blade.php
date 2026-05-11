@extends('users.admin.layout')

@section('title')
Student Detail
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/show.css') }}">
@endsection
@section('content')
<div class="show_container">
    <image src="{{ asset('storage/'.$user->image)}}" alt="studen_piture" class="student-image">
        <div class="student-details">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>
        <div class="btn">
            {{-- <a href="{{ route('students.edit', $student->id) }}">Update</a> --}}
        </div>
</div>

@endsection