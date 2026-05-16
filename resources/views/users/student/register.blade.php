@extends('users.admin.layout')

@section('title')
Student Registration
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                    {{-- Student information--}}
                    <h4><i class="fas fa-user-graduate me-2"></i>Student Information</h4>
                  <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @error('first_name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>  
                    </div>

                  
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" optional>
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>

                         <div class="col-md-6 form-group">
                            <label for="Date of birth">Date of birth</label>
                            <input type="date" class="form-control" id="student_date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                   <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                            @error('address')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}" required>
                            @error('image')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
               
                    {{-- Password --}}
                    {{-- <div class="row">
                        <div class="col-md-6 form-group password-group">
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
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-6 form-group password-group">
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
                        @error('password_confirmation')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div> --}}
                    

                  {{-- Father's / Guardian Information --}}
<h4><i class="fas fa-user me-2"></i>Father's/Guardian's Information</h4>

<div class="row">

    <div class="col-md-6 form-group">
        <label for="father_first_name">First Name</label>
        <input type="text" class="form-control" id="father_first_name" name="father_first_name" value="{{ old('father_first_name') }}">

        @error('father_first_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="father_last_name">Last Name</label>
        <input type="text" class="form-control" id="father_last_name" name="father_last_name" value="{{ old('father_last_name') }}">

        @error('father_last_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="row">

    <div class="col-md-6 form-group">
        <label for="phone_no">Phone Number</label>
        <input type="text" class="form-control" id="phone_no" name="phone_no" value="{{ old('phone_no') }}">

        @error('phone_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="father_occupation">Occupation</label>
        <input type="text" class="form-control" id="father_occupation" name="father_occupation" value="{{ old('father_occupation') }}">

        @error('father_occupation')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="row">

    <div class="col-md-6 form-group">
        <label for="father_email">Email</label>
        <input type="email" class="form-control" id="father_email" name="father_email" value="{{ old('father_email') }}">

        @error('father_email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="father_age">Age</label>
        <input type="number" class="form-control" id="father_age" name="father_age" value="{{ old('father_age') }}">

        @error('father_age')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="row">

    <div class="col-md-6 form-group">
        <label for="father_address">Address</label>
        <input type="text" class="form-control" id="father_address" name="father_address" value="{{ old('father_address') }}">

        @error('father_address')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


{{-- Mother's Information --}}
<h4><i class="fas fa-user-shield me-2"></i>Mother's Information</h4>

<div class="row">

    <div class="col-md-6 form-group">
        <label for="mother_first_name">First Name</label>
        <input type="text" class="form-control" id="mother_first_name" name="mother_first_name" value="{{ old('mother_first_name') }}">

        @error('mother_first_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="mother_last_name">Last Name</label>
        <input type="text" class="form-control" id="mother_last_name" name="mother_last_name" value="{{ old('mother_last_name') }}">

        @error('mother_last_name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="row">

    <div class="col-md-6 form-group">
        <label for="mother_phone_no">Phone Number</label>
        <input type="text" class="form-control" id="mother_phone_no" name="mother_phone_no" value="{{ old('mother_phone_no') }}">

        @error('mother_phone_no')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="mother_age">Age</label>
        <input type="number" class="form-control" id="mother_age" name="mother_age" value="{{ old('mother_age') }}">

        @error('mother_age')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="row">

    <div class="col-md-6 form-group">
        <label for="mother_email">Email</label>
        <input type="email" class="form-control" id="mother_email" name="mother_email" value="{{ old('mother_email') }}">

        @error('mother_email')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6 form-group">
        <label for="mother_occupation">Occupation</label>
        <input type="text" class="form-control" id="mother_occupation" name="mother_occupation" value="{{ old('mother_occupation') }}">

        @error('mother_occupation')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>


<div class="row">

    <div class="col-md-6 form-group">
        <label for="mother_address">Address</label>
        <input type="text" class="form-control" id="mother_address" name="mother_address" value="{{ old('mother_address') }}">

        @error('mother_address')
            <div class="text-danger">{{ $message }}</div>
        @enderror
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