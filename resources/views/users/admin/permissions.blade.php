@extends('users.admin.layout')

@section('title')
Permissions
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
:root {
    --header-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    max-width: 1200px;
    margin: 0 auto;
    overflow: hidden;
}

.page-header {
    background: var(--header-gradient);
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
    padding: 2rem;
}

.permissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.permission-card {
    padding: 1.5rem;
    border-radius: 12px;
    background: linear-gradient(135deg, #f8fafc 0%, #ffffff 100%);
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.permission-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
    border-color: #667eea;
}

.permission-card h3 {
    margin: 0 0 1rem 0;
    color: #111827;
    text-transform: capitalize;
    font-size: 1.1rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.permission-card h3 i {
    color: #667eea;
    font-size: 1.25rem;
}

.permission-list {
    margin: 0;
    padding-left: 1.25rem;
    color: #4b5563;
    line-height: 1.8;
}

.permission-list li {
    margin-bottom: 0.5rem;
}

.permission-list li:before {
    content: '✓ ';
    color: #43e97b;
    font-weight: bold;
    margin-right: 0.5rem;
}

@media (max-width: 768px) {
    .page-header {
        padding: 1.5rem;
    }

    .page-body {
        padding: 1rem;
    }

    .permissions-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

@section('content')
<div class="page-container">
    <div class="page-card">
        <div class="page-header">
            <h1><i class="fas fa-key me-3"></i>Role-Based Permissions</h1>
        </div>

        <div class="page-body">
            <div class="permissions-grid">
                @foreach($permissions as $role => $capabilities)
                <div class="permission-card">
                    <h3>
                        <i class="fas fa-shield-alt"></i>
                        {{ ucwords(str_replace('_', ' ', $role)) }}
                    </h3>
                    <ul class="permission-list">
                        @foreach($capabilities as $permission)
                        <li>{{ ucfirst(str_replace('_', ' ', $permission)) }}</li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
