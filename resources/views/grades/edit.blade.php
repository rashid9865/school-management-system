@extends('users.admin.layout')

@section('title')
Edit Grade
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
.form-control:focus {
    border-radius: 12px;
    border: 1px solid #d1d5db;
    padding: 0.95rem 1rem;
    box-shadow: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-control:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 0.15rem rgba(99, 102, 241, 0.15);
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
            <div class="form-card-header">
                <h2><i class="fas fa-graduation-cap me-2"></i>Edit Grade</h2>
            </div>
            <div class="form-card-body">
                <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="grade_name">Name</label>
                        <input type="text" class="form-control" id="grade_name" name="name" value="{{ $grade->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="grade_description">Description</label>
                        <input type="text" class="form-control" id="grade_description" name="description" value="{{ $grade->description }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Update Grade</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection