<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | School Management</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-head">
                <h1>Create Your Account</h1>
                <p>Register as Admin to access the school dashboard.</p>
            </div>

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

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter full name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                </div>

                <div class="form-group password-group">
                    <label for="password">Password</label>
                    <div class="password-field">
                        <input type="password" id="password" name="password" placeholder="Enter password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">Show</button>
                    </div>
                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                </div>

                <div class="form-group password-group">
                    <label for="password-confirmation">Confirm Password</label>
                    <div class="password-field">
                        <input type="password" id="password-confirmation" name="password_confirmation" placeholder="Confirm password" required>
                        <button type="button" class="toggle-password" onclick="togglePassword('password-confirmation')">Show</button>
                    </div>
                @error('password_confirmation')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                </div>

                <div class="form-group">
                    <label for="image">Profile Photo</label>
                    <input type="file" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
                </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter address" value="{{ old('address') }}">
                    @error('address')
                        <div class="text-danger">
                            {{ $message }}
                        </div>  
                    @enderror
                    </div>
               

                <div id="teacherFields" class="role-fields" style="display: none;">
                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" id="qualification" name="qualification" placeholder="Enter qualification" value="{{ old('qualification') }}">
                    @error('qualification')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="date">Hire Date</label>
                        <input type="date" id="date" name="hire_date" value="{{ old('hire_date') }}">
                    @error('hire_date')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
                <div class="form-group">
                    <label for="birth-date">Birth Date</label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                     @error('birth_date')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" class="form-select" name="gender">
                        <option value="">Select Gender</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                        @error('gender')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                

                <button type="submit" class="submit_button">Register</button>
            </form>

            <p class="meta-text">Already have an account? <a href="{{ route('user.login') }}">Login here</a></p>
        </div>
    </div>

    <script>
        function showFields() {
            const role = document.getElementById('role').value;
            const studentFields = document.getElementById('studentFields');
            const teacherFields = document.getElementById('teacherFields');

            studentFields.style.display = role === 'student' ? 'block' : 'none';
            teacherFields.style.display = role === 'teacher' ? 'block' : 'none';
        }

        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }

        document.addEventListener('DOMContentLoaded', function () {
            showFields();
        });
    </script>
</body>

</html>