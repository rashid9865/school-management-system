@extends('users.teacher.layout')
@section('title')
My Classes
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

.teacherclasses-container {
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

.subjects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-top: 2rem;
}

.subject-card {
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border-radius: 16px;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.1);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(102, 126, 234, 0.1);
    position: relative;
    overflow: hidden;
}

.subject-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
}

.subject-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(102, 126, 234, 0.2);
}

.subject-card h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 1.5rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.subject-card p {
    margin: 0.75rem 0;
    font-size: 1rem;
    color: #475569;
    line-height: 1.6;
}

.subject-card strong {
    color: #1f2937;
    font-weight: 600;
}

.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: #6b7280;
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

.status-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 999px;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    color: white;
    margin-top: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .teacherclasses-container {
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

    .subjects-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .subject-card {
        padding: 1.5rem;
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

.subject-card {
    animation: fadeInUp 0.6s ease-out;
    animation-delay: 0.2s;
    animation-fill-mode: both;
}
</style>
@endsection
@section('content')
<div class="teacherclasses-container">
    <div class="container-fluid">
        <div class="professional-card">
            <div class="card-header-professional">
                <h1><i class="fas fa-chalkboard-teacher me-3"></i>My Classes</h1>
            </div>
            <div class="card-body-professional">
                @if($subjects->count() > 0)
                    <div class="subjects-grid">
                        @foreach($subjects as $subject)
                            <div class="subject-card">
                                <h3>{{ $subject->name }}</h3>
                                <p><strong><i class="fas fa-barcode me-2"></i>Code:</strong> {{ $subject->code ?? 'N/A' }}</p>
                                <p><strong><i class="fas fa-align-left me-2"></i>Description:</strong> {{ $subject->description ?? 'No description' }}</p>
                                <p><strong><i class="fas fa-toggle-on me-2"></i>Status:</strong> 
                                    <span class="status-badge">{{ $subject->status ?? 'Active' }}</span>
                                </p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-chalkboard"></i>
                        <p>No subjects assigned yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection