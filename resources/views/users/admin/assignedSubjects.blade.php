@extends('users.admin.layout');

@section('title')
Assigned Subjects to Teachers
@endsection

@section('css')
<style>
    .assigned-subjects-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        padding: 2rem 0;
    }

    .assigned-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        max-width: 1200px;
        margin: 0 auto;
    }

    .assigned-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .assigned-header h1 {
        margin: 0;
        font-weight: 700;
        font-size: 1.75rem;
    }

    .assigned-content {
        padding: 2rem;
    }

    .teacher-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        transition: transform 0.2s;
    }

    .teacher-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .teacher-name {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .teacher-name i {
        color: #4facfe;
    }

    .subjects-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .subject-badge {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .no-subjects {
        color: #64748b;
        font-style: italic;
    }

    .no-teachers {
        text-align: center;
        padding: 3rem;
        color: #64748b;
    }
</style>
@endsection

@section('content')
<div class="assigned-subjects-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="assigned-card">
                    <div class="assigned-header">
                        <h1><i class="fas fa-chalkboard-teacher me-3"></i>Assigned Subjects to Teachers</h1>
                    </div>
                    <div class="assigned-content">
                        @if($teachers->count() > 0)
                            @foreach($teachers as $teacher)
                                <div class="teacher-card">
                                    <div class="teacher-name">
                                        <i class="fas fa-user-graduate"></i>
                                        {{ $teacher->name }}
                                    </div>
                                    <div class="subjects-list">
                                        @if($teacher->subjects->count() > 0)
                                            @foreach($teacher->subjects as $subject)
                                                <span class="subject-badge">{{ $subject->name }}</span>
                                            @endforeach
                                        @else
                                            <span class="no-subjects">No subjects assigned</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-teachers">
                                <i class="fas fa-info-circle fa-3x mb-3"></i>
                                <p>No teachers found.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection