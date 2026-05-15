@extends('users.admin.layout')

@section('title')
Update Teacher
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.page-section {
    padding: 2rem 0;
}

.form-card {
    background: #ffffff;
    border-radius: 18px;
    box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
    overflow: hidden;
}

.form-card-header {
    padding: 2rem 2.5rem;
    background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
    color: #ffffff;
}

.form-card-header h2 {
    margin: 0;
    font-size: 1.9rem;
    letter-spacing: -0.5px;
}

.form-card-body {
    padding: 2.5rem;
}

.form-group {
    margin-bottom: 1.3rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.65rem;
    font-weight: 600;
    color: #0f172a;
}

.form-control,
.form-control:focus,
.form-select,
.form-textarea {
    border-radius: 12px;
    border: 1px solid #d1d5db;
    padding: 0.95rem 1rem;
    box-shadow: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-control:focus,
.form-select:focus,
.form-textarea:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.15rem rgba(99, 102, 241, 0.15);
}

.form-textarea {
    min-height: 140px;
    resize: vertical;
}

.btn-primary {
    background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
    border: none;
    padding: 0.95rem 1.75rem;
    border-radius: 999px;
    box-shadow: 0 12px 26px rgba(79, 70, 229, 0.18);
}

.btn-primary:hover {
    opacity: 0.95;
}

@media (max-width: 768px) {
    .form-card-body {
        padding: 1.5rem;
    }
}
</style>
@endsection

@section('content')
<div class="page-section">
    <div class="container">
        <div class="form-card">
            <div class="form-card-header d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
                <h2><i class="fas fa-chalkboard-teacher me-2"></i>Update Teacher</h2>
            </div>
            <div class="form-card-body">
                <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $teacher->name }}" required>
                        @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $teacher->email }}" required>
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $teacher->phone }}" required>
                        @error('phone')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="qualification">Qualification</label>
                            <input type="text" class="form-control" id="qualification" name="qualification" value="{{ $teacher->qualification }}" required>
                        @error('qualification')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="hire_date">Hire Date</label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date" value="{{ $teacher->hire_date }}" required>
                        @error('hire_date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>  
                        @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" class="form-select" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" {{ $teacher->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $teacher->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ $teacher->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        @error('gender')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="birth_date">Birth Date</label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ $teacher->birth_date }}">
                        @error('birth_date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
            
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea id="address" class="form-textarea form-control" name="address">{{ $teacher->address }}</textarea>
                    @error('address')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Profile Picture</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-2"><i class="fas fa-save me-2"></i>Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection