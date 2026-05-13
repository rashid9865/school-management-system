@extends('users.admin.layout')

@section('title')
    Create Grade
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
:root {
    --card-bg: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    --header-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --btn-primary: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --btn-success: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    --btn-warning: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    --btn-danger: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    --shadow-light: 0 2px 10px rgba(0, 0, 0, 0.08);
    --shadow-medium: 0 4px 20px rgba(0, 0, 0, 0.12);
    --shadow-heavy: 0 8px 30px rgba(0, 0, 0, 0.15);
}

.grades-create-container {
    background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    min-height: 100vh;
    padding: 2.5rem 0;
}

.professional-create-card {
    background: white;
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    margin: 0 auto;
    max-width: 800px;
}

.professional-create-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
}

.create-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 65%, #5a4d8f 100%);
    color: white;
    border: none;
    padding: 3rem 2.5rem;
    position: relative;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.create-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
}

.create-card-header h1 {
    position: relative;
    z-index: 1;
    margin: 0;
    font-weight: 800;
    font-size: 2rem;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    letter-spacing: -0.5px;
}

.create-form-section {
    padding: 3rem;
}

.form-group-professional {
    margin-bottom: 2rem;
}

.form-label-professional {
    display: block;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

.form-control-professional,
.form-textarea-professional {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
    box-sizing: border-box;
}

.form-textarea-professional {
    min-height: 140px;
    resize: vertical;
}

.form-control-professional:focus,
.form-textarea-professional:focus {
    outline: none;
    border-color: #4facfe;
    box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
    transform: translateY(-1px);
}

.form-control-professional::placeholder,
.form-textarea-professional::placeholder {
    color: #94a3b8;
    font-style: italic;
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
    box-shadow: 0 4px 15px rgba(67, 233, 123, 0.3);
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

.text-danger {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .grades-create-container {
        padding: 1rem 0;
    }

    .create-card-header {
        padding: 2rem 1.5rem;
    }

    .create-card-header h1 {
        font-size: 1.5rem;
    }

    .create-form-section {
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

.professional-create-card {
    animation: fadeInUp 0.6s ease-out;
}
</style>
@endsection

@section('content')
<div class="grades-create-container">
    <div class="container-fluid">
        <div class="professional-create-card">
            <div class="create-card-header">
                <h1><i class="fas fa-graduation-cap me-3"></i>Create Grade</h1>
            </div>
            <div class="create-form-section">
                <form action="{{ route('grades.store') }}" method="POST" id="gradeForm">
                    @csrf

                    <div class="form-group-professional">
                        <label for="name" class="form-label-professional">
                            <i class="fas fa-graduation-cap me-2"></i>Grade Name <span class="required-indicator">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            class="form-control-professional"
                            placeholder="Enter the grade name (e.g., Grade 1, Grade 2, Grade 3)"
                            required
                            maxlength="255"
                        >
                        <div class="form-help-text">
                            <i class="fas fa-info-circle me-1"></i>Enter a clear and descriptive name for the grade.
                        </div>
                        @error('name')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group-professional">
                        <label for="description" class="form-label-professional">
                            <i class="fas fa-align-left me-2"></i>Description
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            class="form-textarea-professional"
                            placeholder="Optional: Add a short note about this grade"
                        ></textarea>
                        <div class="form-help-text">
                            <i class="fas fa-info-circle me-1"></i>Optional description helps users understand the grade details.
                        </div>
                        @error('description')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit-professional">
                            <i class="fas fa-save"></i>
                            <span>Create Grade</span>
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
</div>
@endsection