@extends('users.admin.layout')

@section('title')
Mark Attendance
@endsection

@section('csrf_token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
:root {
    --header-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --btn-primary: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.08);
    --shadow-medium: 0 4px 20px rgba(0, 0, 0, 0.12);
}

* {
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.page-container {
    background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    min-height: 100vh;
    padding: 2.5rem 0;
}

.page-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    max-width: 800px;
    margin: 0 auto;
    overflow: hidden;
}

.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 2.5rem;
}

.page-header h1 {
    margin: 0;
    font-size: 2rem;
    font-weight: 800;
    letter-spacing: -0.5px;
}

.page-body {
    padding: 2.5rem;
}

.form-group {
    display: grid;
    gap: 10px;
    margin-bottom: 1.5rem;
}

.form-group label {
    font-weight: 700;
    color: #0f172a;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.form-group select,
.form-group input {
    width: 100%;
    min-height: 48px;
    border-radius: 12px;
    padding: 12px 16px;
    border: 1px solid #cbd5e1;
    background: #f8fbff;
    color: #0f172a;
    font-size: 0.98rem;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-group select:focus,
.form-group input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.16);
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}

.btn {
    padding: 12px 28px;
    border-radius: 10px;
    font-size: 0.95rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-primary {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
}

.btn-secondary {
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
    color: #1f2937;
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.alert {
    padding: 1.25rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.alert-success {
    background: #ecfdf5;
    border: 1px solid #d1fae5;
    color: #166534;
}

.alert-error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #991b1b;
}

.alert i {
    font-size: 1.25rem;
    margin-top: 0.1rem;
}

@media (max-width: 768px) {
    .page-card {
        margin: 1rem;
    }

    .page-header,
    .page-body {
        padding: 1.5rem;
    }

    .page-header h1 {
        font-size: 1.5rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn {
        width: 100%;
        justify-content: center;
    }
}
</style>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@section('content')
<div class="page-container">
    <div class="page-card">
        <div class="page-header">
            <h1><i class="fas fa-user-check me-3"></i>Mark Attendance</h1>
        </div>

        <div class="page-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        <strong>Please fix the following errors:</strong>
                        <ul style="margin: 0.5rem 0 0 1rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.attendance.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="student_id"><i class="fas fa-user me-2"></i>Select Student</label>
                    <select name="student_id" id="student_id" required>
                        <option value="">-- Choose a student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->user->name ?? $student->name }} ({{ $student->user->email ?? $student->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date"><i class="fas fa-calendar me-2"></i>Date</label>
                    <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required>
                </div>

                <div class="form-group">
                    <label for="status"><i class="fas fa-info-circle me-2"></i>Status</label>
                    <select name="status" id="status" required>
                        <option value="">-- Select Status --</option>
                        <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                        <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i>Mark Attendance
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection