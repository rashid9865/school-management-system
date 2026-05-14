@extends('users.admin.layout')

@section('title')
Teacher Details
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
.page-section {
    padding: 2rem 0;
}

.detail-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
    overflow: hidden;
}

.detail-card-header {
    padding: 2rem 2.5rem;
    background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
    color: #ffffff;
}

.detail-card-header h2 {
    margin: 0;
    font-size: 1.95rem;
    letter-spacing: -0.5px;
}

.detail-card-body {
    padding: 2.5rem;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 1.5rem;
}

.detail-item {
    background: #f8fafc;
    border-radius: 14px;
    padding: 1.35rem 1.5rem;
    border: 1px solid #e5e7eb;
}

.detail-item strong {
    display: block;
    color: #334155;
    margin-bottom: 0.6rem;
    font-size: 0.95rem;
}

.detail-item span {
    color: #0f172a;
    font-size: 1rem;
}

.detail-actions {
    margin-top: 1.75rem;
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.btn-secondary {
    background: #e2e8f0;
    border: none;
    color: #0f172a;
    padding: 0.9rem 1.4rem;
    border-radius: 999px;
    cursor: pointer;
}

.btn-secondary:hover {
    background: #cbd5e1;
}

@media (max-width: 768px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection

@section('content')
<div class="page-section">
    <div class="container">
        <div class="detail-card">
            <div class="detail-card-header d-flex justify-content-between align-items-center flex-column flex-md-row gap-3">
                <h2><i class="fas fa-chalkboard-teacher me-2"></i>Teacher Details</h2>
                <div class="detail-actions">
                    <button type="button" class="btn-secondary" onclick="history.back()">
                        <i class="fas fa-arrow-left me-2"></i>Back
                    </button>
                </div>
            </div>
            <div class="detail-card-body">
                <div class="detail-grid">
                    @if(isset($teacher))
                    <div class="detail-item">
                        <strong>Name</strong>
                        <span>{{ $teacher->name ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <strong>Email</strong>
                        <span>{{ $teacher->email ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <strong>Phone</strong>
                        <span>{{ $teacher->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <strong>Qualification</strong>
                        <span>{{ $teacher->qualification ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <strong>Hire Date</strong>
                        <span>{{ $teacher->hire_date ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-item">
                        <strong>Status</strong>
                        <span>{{ $teacher->status ?? 'N/A' }}</span>
                    </div>
                    @else
                    <div class="detail-item" style="grid-column: span 2; text-align: center;">
                        <span>No teacher record found.</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection