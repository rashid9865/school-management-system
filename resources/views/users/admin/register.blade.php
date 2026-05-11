@extends('users.admin.layout')
@section('title')
Register User
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection
@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-card-header">
            <div class="auth-card-title">
                <span class="eyebrow">Admin registration</span>
                <h1>Create a Secure Admin Account</h1>
                <p>Use this form to add a new administrator for the school dashboard.</p>
            </div>
            <div class="auth-badge">Secure</div>
        </div>
          <div class="auth-card-body">
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

            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf

                <div class="form-grid">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter full name" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group password-group">
                        <label for="password">Password</label>
                        <div class="password-field">
                            <input type="password" id="password" name="password" placeholder="Enter password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password')">Show</button>
                        </div>
                    </div>

                    <div class="form-group password-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <div class="password-field">
                            <input type="password" id="password-confirmation" name="password_confirmation" placeholder="Confirm password" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password-confirmation')">Show</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Profile Photo</label>
                        <input type="file" id="image" name="image" accept="image/*">
                    </div>
                </div>

                <button type="submit" class="submit_button">Register</button>
            </form>

            <p class="meta-text">All fields are required to create a secure admin account.</p>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        if (!field) return;
        field.type = field.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection