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
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.professional-assign-card {
    background: var(--card-bg);
    border: none;
    border-radius: 16px;
    box-shadow: var(--shadow-medium);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    backdrop-filter: blur(10px);
    max-width: 780px;
    margin: 0 auto;
}

.professional-assign-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-heavy);
}

.assign-card-header {
    background: var(--header-gradient);
    color: white;
    border: none;
    padding: 2rem;
    position: relative;
}

.assign-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
}

.assign-card-header h1 {
    position: relative;
    z-index: 1;
    margin: 0;
    font-weight: 700;
    font-size: 1.75rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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
    background: var(--btn-secondary);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    color: #475569;
    font-size: 1.05rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(168, 237, 234, 0.3);
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
    gap: 0.5rem;
    color: #64748b;
    text-decoration: none;
    font-weight: 500;
    margin-bottom: 1rem;
    transition: color 0.2s ease;
}

.back-link:hover {
    color: #475569;
}

@media (max-width: 768px) {
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
}
</style>
@endsection

@section('content')
<div class="assign-container">
    <a href="{{ route('grades.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Back to Grades
    </a>
    <div class="professional-assign-card">
        <div class="assign-card-header">
            <h1><i class="fas fa-user-plus me-2"></i>Assign Student to Grade</h1>
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
                        Grade <span class="required-indicator">*</span>
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
                        Choose the grade to assign the student to.
                    </div>
                    @error('grade_id')
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group-professional">
                    <label for="student_id" class="form-label-professional">
                        Student <span class="required-indicator">*</span>
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
                        Select the student to assign to the selected grade.
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