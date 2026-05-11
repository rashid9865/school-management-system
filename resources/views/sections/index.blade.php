@extends('users.admin.layout')

@section('title')
    All Sections
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
:root {
    --card-bg: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    --header-gradient: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%);
    --button-primary: linear-gradient(135deg, #0ea5e9 0%, #2563eb 100%);
    --button-secondary: linear-gradient(135deg, #e2e8f0 0%, #f8fafc 100%);
    --shadow-light: 0 2px 18px rgba(15, 23, 42, 0.08);
}

.sections-index-container {
    min-height: 100vh;
    padding: 2.5rem 1rem;
    background: linear-gradient(135deg, #eef2ff 0%, #f8fafc 100%);
}

.sections-card {
    max-width: 1100px;
    margin: 0 auto;
    background: var(--card-bg);
    border-radius: 24px;
    box-shadow: var(--shadow-light);
    overflow: hidden;
}

.sections-card-header {
    background: var(--header-gradient);
    color: #ffffff;
    padding: 2rem 2.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
}

.sections-card-header h1 {
    margin: 0;
    font-size: 1.9rem;
    letter-spacing: -0.03em;
}

.sections-card-header .btn-new-section {
    display: inline-flex;
    align-items: center;
    gap: 0.6rem;
    padding: 0.9rem 1.3rem;
    border-radius: 999px;
    border: none;
    background: var(--button-primary);
    color: white;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.sections-card-header .btn-new-section:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 24px rgba(59, 130, 246, 0.22);
}

.sections-card-body {
    padding: 2rem;
}

.sections-table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 18px;
}

.sections-table th,
.sections-table td {
    padding: 1.2rem 1.1rem;
    text-align: left;
    border-bottom: 1px solid #e2e8f0;
}

.sections-table thead th {
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: #475569;
    background: #f8fafc;
}

.sections-table tbody tr:hover {
    background: rgba(59, 130, 246, 0.05);
}

.sections-table tbody td {
    color: #334155;
    font-size: 0.97rem;
}

.empty-state {
    padding: 2rem;
    text-align: center;
    color: #475569;
    background: #f8fafc;
    border: 1px dashed #cbd5e1;
    border-radius: 16px;
    margin-top: 1rem;
}

@media (max-width: 820px) {
    .sections-card-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .sections-table th,
    .sections-table td {
        padding: 1rem 0.8rem;
    }
}
</style>
@endsection

@section('content')
<div class="sections-index-container">
    <div class="sections-card">
        <div class="sections-card-header">
            <div>
                <h1><i class="fas fa-layer-group"></i> All Sections</h1>
                <p style="margin:0.5rem 0 0; color:#e2e8f0;">Section list for all grades.</p>
            </div>
            <a href="{{ route('sections.create') }}" class="btn-new-section">
                <i class="fas fa-plus"></i>
                Create Section
            </a>
        </div>
        <div class="sections-card-body">
            @if($sections->count())
                <table class="sections-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Section Name</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sections as $index => $section)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->grade->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <p><strong>No sections found yet.</strong> Click "Create Section" to add the first section.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection