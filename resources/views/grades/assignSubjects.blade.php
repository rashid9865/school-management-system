@extends('users.admin.layout')

@section('title', 'Assign Subjects to Grades')

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

.assign-container {
    background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
    min-height: 100vh;
    padding: 2.5rem 0;
}

.professional-card {
    background: white;
    border: none;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    margin: 0 auto;
    max-width: 1200px;
}

.professional-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
}

.card-header-professional {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 65%, #5a4d8f 100%);
    color: white;
    border: none;
    padding: 3rem 2.5rem;
    position: relative;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.card-header-professional::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
}

.card-header-professional h1 {
    position: relative;
    z-index: 1;
    margin: 0;
    font-weight: 800;
    font-size: 2rem;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    letter-spacing: -0.5px;
}

.card-body-professional {
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

.btn-assign-professional {
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
}

.btn-assign-professional:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(67, 233, 123, 0.4);
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    margin-top: 2rem;
}

.data-table th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.25rem 1rem;
    text-align: left;
    font-weight: 600;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.data-table td {
    padding: 1.25rem 1rem;
    border-bottom: 1px solid #f1f5f9;
    transition: background-color 0.2s ease;
}

.data-table tr:hover td {
    background: #f8fafc;
}

.data-table tr:last-child td {
    border-bottom: none;
}

.btn-remove {
    background: var(--btn-danger);
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.875rem;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-remove:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
}

.alert {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    font-weight: 500;
}

.alert-success {
    background: #dcfce7;
    color: #14532d;
    border: 1px solid #bbf7d0;
}

.alert-info {
    background: #cffafe;
    color: #164e63;
    border: 1px solid #a5f3fc;
}

.alert-danger {
    background: #fee2e2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #6b7280;
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border: 2px dashed #e2e8f0;
    border-radius: 16px;
    margin-top: 2rem;
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    opacity: 0.3;
}

.empty-state p {
    font-size: 1.2rem;
    margin: 0;
}

.text-danger {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .assign-container {
        padding: 1rem 0;
    }

    .card-header-professional {
        padding: 2rem 1.5rem;
    }

    .card-header-professional h1 {
        font-size: 1.5rem;
    }

    .card-body-professional {
        padding: 2rem 1.5rem;
    }

    .data-table th,
    .data-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
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

.professional-card {
    animation: fadeInUp 0.6s ease-out;
}
</style>
@endsection

@section('content')
<div class="assign-container">
    <div class="container-fluid">
        <div class="professional-card">
            <div class="card-header-professional">
                <h1><i class="fas fa-book-open me-3"></i>Assign Subjects to Grades</h1>
            </div>
            <div class="card-body-professional">
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>{{ session('info') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('storeSubjectAssignment') }}" method="POST">
                    @csrf
                    
                    <div class="form-group-professional">
                        <label for="grade_id" class="form-label-professional">
                            <i class="fas fa-graduation-cap me-2"></i>Select Grade <span class="required-indicator">*</span>
                        </label>
                        <select name="grade_id" id="grade_id" class="form-select-professional" required>
                            <option value="">-- Select a grade --</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                        @error('grade_id')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group-professional">
                        <label for="subject_id" class="form-label-professional">
                            <i class="fas fa-book me-2"></i>Select Subject <span class="required-indicator">*</span>
                        </label>
                        <select name="subject_id" id="subject_id" class="form-select-professional" required>
                            <option value="">-- Select a subject --</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        @error('subject_id')
                            <div class="text-danger">
                                <i class="fas fa-exclamation-triangle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-assign-professional">
                        <i class="fas fa-link"></i>
                        <span>Assign Subject to Grade</span>
                    </button>
                </form>

                {{-- Display Current Assignments --}}
                <div style="margin-top: 3rem;">
                    <h3 style="color: #1f2937; margin-bottom: 1.5rem; font-size: 1.5rem; font-weight: 700;">
                        <i class="fas fa-list me-2"></i>Current Assignments
                    </h3>
                    
                    @php
                        $hasAssignments = false;
                        foreach($grades as $grade) {
                            if($grade->subjects()->count() > 0) {
                                $hasAssignments = true;
                                break;
                            }
                        }
                    @endphp

                    @if($hasAssignments)
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-graduation-cap me-1"></i>Grade</th>
                                        <th><i class="fas fa-book me-1"></i>Subject</th>
                                        <th><i class="fas fa-cogs me-1"></i>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($grades as $grade)
                                        @foreach($grade->subjects as $subject)
                                            <tr>
                                                <td>{{ $grade->name }}</td>
                                                <td>{{ $subject->name }}</td>
                                                <td>
                                                    <form method="POST" action="{{ route('removeSubjectAssignment', [$grade->id, $subject->id]) }}" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-remove" onclick="return confirm('Are you sure you want to remove this assignment?')">
                                                            <i class="fas fa-trash"></i>Remove
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fas fa-book-open"></i>
                            <p>No subjects assigned to any grade yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
