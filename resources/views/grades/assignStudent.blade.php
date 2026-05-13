@extends('users.admin.layout')

@section('title')
    Assign Student to Grade
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
:root {
    --card-bg: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    --header-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --btn-primary: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --btn-success: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    --btn-secondary: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    --shadow-medium: 0 4px 20px rgba(0, 0, 0, 0.12);
    --shadow-heavy: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.assign-container {
    background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    min-height: 100vh;
    padding: 2.5rem 0;
}

.professional-assign-card {
    background: white;
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    margin: 0 auto;
    max-width: 800px;
}

.professional-assign-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
}

.assign-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 65%, #5a4d8f 100%);
    color: white;
    border: none;
    padding: 3rem 2.5rem;
    position: relative;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.assign-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
}

.assign-card-header h1 {
    position: relative;
    z-index: 1;
    margin: 0;
    font-weight: 800;
    font-size: 2rem;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    letter-spacing: -0.5px;
}

.assign-form-section {
    padding: 3rem;
}

.form-group-professional {
    margin-bottom: 1.75rem;
}

.form-label-professional {
    display: block;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

.form-select-professional {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
    box-sizing: border-box;
    cursor: pointer;
}

.form-select-professional:focus {
    outline: none;
    border-color: #4facfe;
    box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
    transform: translateY(-1px);
}

.btn-submit-professional {
    background: var(--btn-success);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    color: white;
    font-size: 1.05rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(67, 233, 123, 0.3);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    margin-right: 1rem;
}

.btn-submit-professional:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(67, 233, 123, 0.4);
}

.btn-cancel-professional {
    background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    color: #475569;
    font-size: 1.05rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(168, 237, 234, 0.3);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
}

.btn-cancel-professional:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(168, 237, 234, 0.4);
}

.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-start;
    align-items: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #e2e8f0;
}

.required-indicator {
    color: #ef4444;
    margin-left: 4px;
}

.form-help-text {
    color: #64748b;
    font-size: 0.92rem;
    margin-top: 0.5rem;
    font-style: italic;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    color: white;
    text-decoration: none;
    font-weight: 600;
    margin-bottom: 2rem;
    padding: 1rem 1.5rem;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
    transition: all 0.3s ease;
}

.back-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(79, 172, 254, 0.4);
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .assign-container {
        padding: 1rem 0;
    }

    .assign-card-header {
        padding: 2rem 1.5rem;
    }

    .assign-card-header h1 {
        font-size: 1.5rem;
    }

    .assign-form-section {
        padding: 2rem 1.5rem;
    }

    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-submit-professional,
    .btn-cancel-professional {
        width: 100%;
        justify-content: center;
    }

    .back-link {
        margin-bottom: 1.5rem;
        padding: 0.75rem 1rem;
    }
}

/* Loading Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.professional-assign-card {
    animation: fadeInUp 0.6s ease-out;
}
</style>
@endsection

@section('content')
<div class="assign-container">
    <div class="container-fluid">
        <a href="{{ route('grades.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>
            Back to Grades
        </a>
        <div class="professional-assign-card">
            <div class="assign-card-header">
                <h1><i class="fas fa-user-plus me-3"></i>Assign Student to Grade</h1>
            </div>
        <div class="assign-form-section">
            @if(session('success'))
                <div class="alert alert-success" style="padding: 1rem; background: #dcfce7; color: #14532d; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #bbf7d0;">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" style="padding: 1rem; background: #fee2e2; color: #991b1b; border-radius: 12px; margin-bottom: 1.5rem; border: 1px solid #fecaca;">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('studentAssigned') }}" method="POST" id="assignForm">
                @csrf

                <div class="form-group-professional">
                    <label for="grade_id" class="form-label-professional">
                        <i class="fas fa-graduation-cap me-2"></i>Grade <span class="required-indicator">*</span>
                    </label>
                    <select
                        id="grade_id"
                        name="grade_id"
                        class="form-select-professional"
                        required
                    >
                        <option value="">Select a grade</option>
                        @foreach($grades as $gradeOption)
                            <option value="{{ $gradeOption->id }}" {{ (isset($grade) && $grade->id == $gradeOption->id) ? 'selected' : '' }}>
                                {{ $gradeOption->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help-text">
                        <i class="fas fa-info-circle me-1"></i>Choose the grade to assign the student to.
                    </div>
                    @error('grade_id')
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group-professional">
                    <label for="student_id" class="form-label-professional">
                        <i class="fas fa-user-graduate me-2"></i>Student <span class="required-indicator">*</span>
                    </label>
                    <select
                        id="student_id"
                        name="student_id"
                        class="form-select-professional"
                        required
                    >
                        <option value="">Select a student</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                {{ $student->name }} ({{ $student->email }})
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help-text">
                        <i class="fas fa-info-circle me-1"></i>Select the student to assign to the selected grade.
                    </div>
                    @error('student_id')
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit-professional">
                        <i class="fas fa-save"></i>
                        <span>Assign Student</span>
                    </button>
                    <a href="{{ route('grades.index') }}" class="btn-cancel-professional">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection