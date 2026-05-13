@extends('users.admin.layout')

@section('title')
Attendance Reports
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

.data-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.data-table th {
    background: var(--header-gradient);
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
}

.data-table tr:hover td {
    background: #f8fafc;
}

.data-table tr:last-child td {
    border-bottom: none;
}

.status-present {
    color: #16a34a;
    font-weight: 700;
}

.status-absent {
    color: #dc2626;
    font-weight: 700;
}

.status-leave {
    color: #ca8a04;
    font-weight: 700;
}

.no-records {
    text-align: center;
    padding: 3rem;
    color: #6b7280;
}

@media (max-width: 768px) {
    .page-body {
        padding: 1rem;
    }

    .data-table th,
    .data-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
    }
}
</style>
@endsection

@section('content')
<div class="page-container">
    <div class="page-card">
        <div class="page-header">
            <h1><i class="fas fa-chart-line me-3"></i>Attendance Reports</h1>
        </div>

        <div class="page-body">
            @if($attendance->isEmpty())
                <div class="no-records">
                    <i class="fas fa-chart-line fa-2x"></i>
                    <p>No attendance records found.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-calendar me-1"></i>Date</th>
                                <th><i class="fas fa-user me-1"></i>Student</th>
                                <th><i class="fas fa-book me-1"></i>Class</th>
                                <th><i class="fas fa-list me-1"></i>Section</th>
                                <th><i class="fas fa-signal me-1"></i>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendance as $record)
                            <tr>
                                <td>{{ $record->date ? \Carbon\Carbon::parse($record->date)->format('d M, Y') : 'N/A' }}</td>
                                <td>{{ $record->student->user->name ?? 'N/A' }}</td>
                                <td>{{ $record->student->grade?->name ?? 'N/A' }}</td>
                                <td>{{ $record->student->section?->name ?? 'N/A' }}</td>
                                <td>
                                    <span class="status-{{ $record->status }}">
                                        @if($record->status === 'present')
                                            <i class="fas fa-check-circle"></i> Present
                                        @elseif($record->status === 'absent')
                                            <i class="fas fa-times-circle"></i> Absent
                                        @else
                                            <i class="fas fa-minus-circle"></i> {{ ucfirst($record->status) }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
