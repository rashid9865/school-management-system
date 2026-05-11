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
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
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

               

                <div id="studentFields" class="role-fields" style="display: none;">
                    <div class="form-group">
                        <label for="father-name">Father / Guardian Name</label>
                        <input type="text" id="father-name" name="father_name" placeholder="Enter father or guardian name" value="{{ old('father_name') }}">
                    </div>
                    <div class="form-row">
                        <div class="form-group half-width">
                            <label for="age">Age</label>
                            <input type="number" id="age" name="age" placeholder="Enter age" value="{{ old('age') }}">
                        </div>
                        <div class="form-group half-width">
                            <label for="roll-no">Roll Number</label>
                            <input type="number" id="roll-no" name="roll_no" placeholder="Enter roll number" value="{{ old('roll_no') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter address" value="{{ old('address') }}">
                    </div>
                </div>

                <div id="teacherFields" class="role-fields" style="display: none;">
                    <div class="form-group">
                        <label for="qualification">Qualification</label>
                        <input type="text" id="qualification" name="qualification" placeholder="Enter qualification" value="{{ old('qualification') }}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter phone number" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label for="date">Hire Date</label>
                        <input type="date" id="date" name="hire_date" value="{{ old('hire_date') }}">
                    </div>
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