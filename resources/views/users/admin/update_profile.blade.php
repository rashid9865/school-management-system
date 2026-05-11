@extends('users.admin.layout')

@section('title')
Update Profile
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/admin/update_profile.css') }}">
@endsection

@section('content')
<div class="update-profile-container">
    <h2>Update Profile Information</h2>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="name-email">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter full name" value="{{ old('name', auth()->user()->name) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" placeholder="Enter email address" value="{{ old('email', auth()->user()->email) }}" required>
        </div>
    </div>
        <div class="form-group">
            <div class="profile-image">
            <img src="{{ asset('storage/' . auth()->user()->image) }}"  id="preview-image" name="image" accept="image/*"  onclick="document.getElementById('image').click()">
            <input type="file" id="image" name="image" accept="image/*" hidden onchange="previewImage(event)">
            </div>
        </div>
        <button type="submit" class="submit_button">Update Profile</button>
    </form>
</div>
@endsection