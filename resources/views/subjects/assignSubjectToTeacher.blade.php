@extends('users.admin.layout');

@section('title')
Assign Subject to Teacher
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
    --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.08);
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
    max-width: 800px;
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
    margin-bottom: 2rem;
}

.form-label-professional {
    display: block;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 0.75rem;
    font-size: 1.1rem;
}

.form-select-professional {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
    color: #0f172a;
    box-sizing: border-box;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.5em 1.5em;
    padding-right: 3rem;
}

.form-select-professional:focus {
    outline: none;
    border-color: #4facfe;
    box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
    transform: translateY(-1px);
}

.form-select-professional option {
    padding: 0.5rem;
    background: white;
    color: #0f172a;
}

.form-help-text {
    color: #64748b;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    font-style: italic;
}

.required-indicator {
    color: #ef4444;
    margin-left: 4px;
}

.btn-submit-professional {
    background: var(--btn-success);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    color: white;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(67, 233, 123, 0.3);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-right: 1rem;
}

.btn-submit-professional:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(67, 233, 123, 0.4);
    color: white;
}

.btn-cancel-professional {
    background: var(--btn-secondary);
    border: none;
    border-radius: 12px;
    padding: 1rem 2rem;
    font-weight: 600;
    color: #64748b;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(168, 237, 234, 0.3);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-cancel-professional:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(168, 237, 234, 0.4);
    color: #64748b;
    text-decoration: none;
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

.assignment-preview {
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid #e2e8f0;
}

.preview-title {
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.preview-content {
    display: flex;
    gap: 2rem;
    align-items: center;
}

.preview-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #64748b;
}

.preview-item i {
    color: #4facfe;
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

    .preview-content {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
}
</style>
@endsection

@section('content')
<div class="assign-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="professional-assign-card">
                    <div class="assign-card-header">
                        <h1><i class="fas fa-user-plus me-3"></i>Assign Subject to Teacher</h1>
                    </div>
                    <div class="assign-form-section">
                        @if(session('success'))
                            <div class="alert alert-success" style="padding: 1rem 1.25rem; margin-bottom: 1.5rem; border-radius: 0.75rem; background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('info'))
                            <div class="alert alert-info" style="padding: 1rem 1.25rem; margin-bottom: 1.5rem; border-radius: 0.75rem; background: #cffafe; color: #0c4a6e; border: 1px solid #7dd3fc;">
                                {{ session('info') }}
                            </div>
                        @endif

                        <div class="assignment-preview">
                            <div class="preview-title">
                                <i class="fas fa-info-circle"></i>
                                Assignment Overview
                            </div>
                            <div class="preview-content">
                                <div class="preview-item">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <span>{{ $teachers->count() }} Teachers Available</span>
                                </div>
                                <div class="preview-item">
                                    <i class="fas fa-book"></i>
                                    <span>{{ $subjects->count() }} Subjects Available</span>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('assign.subject') }}" method="POST" id="assignForm">
                            @csrf

                            <div class="form-group-professional">
                               
                                <label for="teacher_id" class="form-label-professional">
                                    Select Teacher <span class="required-indicator">*</span>
                                </label>
                                <select name="teacher_id" id="teacher_id" class="form-select-professional" required>
                                    <option value="">-- Choose a Teacher --</option>
                                    @foreach($teachers as $teacher)
                        
                                        <option value="{{ $teacher->id }}">
                                            {{ $teacher->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-help-text">
                                    Choose the teacher who will be assigned to teach this subject
                                </div>
                                @error('teacher_id')
                                    <div class="text-danger mt-2">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group-professional">
                                <label for="subject_id" class="form-label-professional">
                                    Select Subject <span class="required-indicator">*</span>
                                </label>
                                <select name="subject_id" id="subject_id" class="form-select-professional" required>
                                    <option value="">-- Choose a Subject --</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-help-text">
                                    Select the subject that will be assigned to the chosen teacher
                                </div>
                                @error('subject_id')
                                    <div class="text-danger mt-2">
                                        <i class="fas fa-exclamation-triangle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-submit-professional">
                                    <i class="fas fa-link"></i>
                                    <span>Assign Subject</span>
                                </button>
                                <a href="{{ route('subjects.index') }}" class="btn-cancel-professional">
                                    <i class="fas fa-times"></i>
                                    <span>Cancel</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('assignForm');
    const teacherSelect = document.getElementById('teacher_id');
    const subjectSelect = document.getElementById('subject_id');

    const assignedSubjectIds = @json($teachers->flatMap(function ($teacher) {
        return $teacher->subjects->pluck('id');
    })->unique()->values());

    function updateSubjectOptions() {
        Array.from(subjectSelect.options).forEach(option => {
            if (!option.value) {
                return;
            }

            const originalText = option.dataset.originalText || option.text;
            option.dataset.originalText = originalText;
            const subjectId = parseInt(option.value, 10);

            if (assignedSubjectIds.includes(subjectId)) {
                option.disabled = true;
                option.text = originalText + ' (Already assigned)';
            } else {
                option.disabled = false;
                option.text = originalText;
            }
        });

        if (subjectSelect.value && subjectSelect.selectedOptions[0].disabled) {
            subjectSelect.value = '';
        }
    }

    teacherSelect.focus();

    teacherSelect.addEventListener('change', function() {
        updateSubjectOptions();
        if (this.value) {
            this.style.borderColor = '#10b981';
        } else {
            this.style.borderColor = '#e2e8f0';
        }
    });

    form.addEventListener('submit', function(e) {
        if (!teacherSelect.value) {
            e.preventDefault();
            alert('Please select a teacher.');
            teacherSelect.focus();
            return false;
        }

        if (!subjectSelect.value) {
            e.preventDefault();
            alert('Please select a subject.');
            subjectSelect.focus();
            return false;
        }
    });

    [teacherSelect, subjectSelect].forEach(select => {
        select.addEventListener('change', function() {
            if (this.value) {
                this.style.borderColor = '#10b981';
            } else {
                this.style.borderColor = '#e2e8f0';
            }
        });
    });

    updateSubjectOptions();
});
</script>
@endsection