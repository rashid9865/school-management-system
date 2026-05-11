@extends('users.admin.layout')

@section('title')
Student Registration
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="auth-page">

    <div class="auth-card">

        {{-- Header --}}
        <div class="auth-card-header">

            <div class="auth-card-title">

                <span class="eyebrow">
                    Student registration
                </span>

                <h1>Create Student Account</h1>

                <p>
                    Register a new student to access the school dashboard.
                </p>

            </div>

            <div class="auth-badge">
                Secure
            </div>

        </div>

        {{-- Body --}}
        <div class="auth-card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('student.store') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  autocomplete="off">

                @csrf

                <div class="form-grid">

                    {{-- Full Name --}}
                    <div class="form-group">
                        <label for="name">Full Name</label>

                        <input type="text"
                               id="name"
                               name="name"
                               placeholder="Enter full name"
                               value="{{ old('name') }}"
                               required>
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">Email Address</label>

                        <input type="email"
                               id="email"
                               name="email"
                               placeholder="you@example.com"
                               value="{{ old('email') }}"
                               required>
                    </div>

                    {{-- Password --}}
                    <div class="form-group password-group">
                        <label for="password">Password</label>

                        <div class="password-field">

                            <input type="password"
                                   id="password"
                                   name="password"
                                   placeholder="Enter password"
                                   required>

                            <button type="button"
                                    class="toggle-password"
                                    onclick="togglePassword('password')">
                                Show
                            </button>

                        </div>
                    </div>

                    {{-- Confirm Password --}}
                    <div class="form-group password-group">
                        <label for="password-confirmation">
                            Confirm Password
                        </label>

                        <div class="password-field">

                            <input type="password"
                                   id="password-confirmation"
                                   name="password_confirmation"
                                   placeholder="Confirm password"
                                   required>

                            <button type="button"
                                    class="toggle-password"
                                    onclick="togglePassword('password-confirmation')">
                                Show
                            </button>

                        </div>
                    </div>

                    {{-- Father Name --}}
                    <div class="form-group">
                        <label for="father-name">
                            Father / Guardian Name
                        </label>

                        <input type="text"
                               id="father-name"
                               name="father_name"
                               placeholder="Enter father or guardian name"
                               value="{{ old('father_name') }}">
                    </div>

                    {{-- Age --}}
                    <div class="form-group">
                        <label for="age">Age</label>

                        <input type="number"
                               id="age"
                               name="age"
                               placeholder="Enter age"
                               value="{{ old('age') }}">
                    </div>

                    {{-- Roll Number --}}
                    <div class="form-group">
                        <label for="roll-no">Roll Number</label>

                        <input type="number"
                               id="roll-no"
                               name="roll_no"
                               placeholder="Enter roll number"
                               value="{{ old('roll_no') }}">
                    </div>

                    {{-- Address --}}
                    <div class="form-group">
                        <label for="address">Address</label>

                        <input type="text"
                               id="address"
                               name="address"
                               placeholder="Enter address"
                               value="{{ old('address') }}">
                    </div>

                    {{-- Profile Image --}}
                    <div class="form-group">
                        <label for="image">Profile Photo</label>

                        <input type="file"
                               id="image"
                               name="image"
                               accept="image/*">
                    </div>

                </div>

                {{-- Submit --}}
                <button type="submit" class="submit_button">
                    Register Student
                </button>

            </form>

            <p class="meta-text">
                Fill all required details to create a student account.
            </p>

        </div>
    </div>
</div>
@endsection


@section('js')
<script>

    function togglePassword(fieldId) {

        const field = document.getElementById(fieldId);

        if (!field) return;

        field.type = field.type === 'password'
            ? 'text'
            : 'password';
    }

</script>
@endsection