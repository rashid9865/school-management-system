@extends('users.admin.layout')

@section('title')
    All Sections
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

.sections-index-container {
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
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
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

.card-header-professional p {
    position: relative;
    z-index: 1;
    margin: 0.5rem 0 0;
    color: rgba(255, 255, 255, 0.9);
    font-size: 1rem;
}

.card-header-professional .btn-new-section {
    position: relative;
    z-index: 1;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    border: none;
    background: var(--btn-success);
    color: white;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(67, 233, 123, 0.3);
}

.card-header-professional .btn-new-section:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(67, 233, 123, 0.4);
}

.card-body-professional {
    padding: 3rem;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
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

.empty-state {
    padding: 4rem 2rem;
    text-align: center;
    color: #6b7280;
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border: 2px dashed #e2e8f0;
    border-radius: 16px;
    margin-top: 1rem;
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

.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 0.875rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-primary {
    background: var(--btn-primary);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
}

.btn-warning {
    background: var(--btn-warning);
    color: white;
}

.btn-warning:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(250, 112, 154, 0.4);
}

.btn-danger {
    background: var(--btn-danger);
    color: white;
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.75rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sections-index-container {
        padding: 1rem 0;
    }

    .card-header-professional {
        flex-direction: column;
        align-items: flex-start;
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

    .action-buttons {
        flex-direction: column;
        gap: 0.25rem;
    }

    .btn {
        padding: 0.5rem;
        font-size: 0.75rem;
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
<div class="sections-index-container">
    <div class="container-fluid">
        <div class="professional-card">
            <div class="card-header-professional">
                <div>
                    <h1><i class="fas fa-layer-group me-3"></i>All Sections</h1>
                    <p>Section list for all grades.</p>
                </div>
                <a href="{{ route('sections.create') }}" class="btn-new-section">
                    <i class="fas fa-plus"></i>
                    Create Section
                </a>
            </div>
            <div class="card-body-professional">
                @if($sections->count())
                    <div class="table-responsive">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-hashtag me-1"></i>#</th>
                                    <th><i class="fas fa-layer-group me-1"></i>Section Name</th>
                                    <th><i class="fas fa-graduation-cap me-1"></i>Grade</th>
                                    <th><i class="fas fa-cogs me-1"></i>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sections as $index => $section)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $section->name }}</td>
                                        <td>{{ $section->grade->name }}</td>
                                        <td>
                                            <div class="action-buttons">
                                                <a href="{{ route('sections.show', $section->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye"></i>View
                                                </a>
                                                <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>Edit
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $section->id }}" data-type="section">
                                                    <i class="fas fa-trash"></i>Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-layer-group"></i>
                        <p><strong>No sections found yet.</strong> Click "Create Section" to add the first section.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection