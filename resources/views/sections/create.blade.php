@extends('users.admin.layout')

@section('title')
    Create Section
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

.sections-create-container {
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
    margin-bottom: 1.75rem;
}

.form-label-professional {
    display: block;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

.form-control-professional,
.form-select-professional {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
    box-sizing: border-box;
}

.form-select-professional {
    cursor: pointer;
}

.form-control-professional:focus,
.form-select-professional:focus {
    outline: none;
    border-color: #4facfe;
    box-shadow: 0 0 0 3px rgba(79, 172, 254, 0.1);
    transform: translateY(-1px);
}

.form-control-professional::placeholder {
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

/* Responsive Design */
@media (max-width: 768px) {
    .sections-create-container {
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
<div class="sections-create-container">
    <div class="container-fluid">
        <div class="professional-create-card">
            <div class="create-card-header">
                <h1><i class="fas fa-layer-group me-3"></i>Create Section</h1>
            </div>
        <div class="create-form-section">
            <form action="{{ route('sections.store') }}" method="POST" id="sectionForm">
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
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="form-help-text">
                        <i class="fas fa-info-circle me-1"></i>Choose the grade for this section.
                    </div>
                    @error('grade_id')
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group-professional">
                    <label for="name" class="form-label-professional">
                        <i class="fas fa-layer-group me-2"></i>Section Name <span class="required-indicator">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control-professional"
                        placeholder="Enter the section name (e.g., A, B, C)"
                        required
                        maxlength="255"
                        value="{{ old('name') }}"
                    >
                    <div class="form-help-text">
                        <i class="fas fa-info-circle me-1"></i>Enter a clear and descriptive name for the section.
                    </div>
                    @error('name')
                        <div class="text-danger mt-2">
                            <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit-professional">
                        <i class="fas fa-save"></i>
                        <span>Create Section</span>
                    </button>
                    <a href="{{ route('sections.index') }}" class="btn-cancel-professional">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection