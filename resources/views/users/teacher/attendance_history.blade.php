@extends('users.teacher.layout')

@section('title')
Attendance History
@endsection

@section('css')
<style>
    .history-container {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        border-bottom: 3px solid #3498db;
        padding-bottom: 15px;
    }

    .page-header h1 {
        font-size: 28px;
        color: #2c3e50;
        margin: 0;
    }

    .filters-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .filter-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        align-items: flex-end;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #2c3e50;
        font-size: 14px;
    }

    .form-group input,
    .form-group select {
        padding: 10px;
        border: 2px solid #ecf0f1;
        border-radius: 5px;
        font-size: 14px;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #3498db;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #95a5a6;
        color: white;
    }

    .stats-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }

    .summary-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        border-left: 4px solid #3498db;
    }

    .summary-card.present {
        border-left-color: #27ae60;
    }

    .summary-card.absent {
        border-left-color: #e74c3c;
    }

    .summary-card.leave {
        border-left-color: #f39c12;
    }

    .summary-value {
        font-size: 32px;
        font-weight: bold;
        color: #2c3e50;
        margin: 10px 0;
    }

    .summary-label {
        font-size: 13px;
        color: #7f8c8d;
    }

    .history-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .history-card h2 {
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 25px;
        border-bottom: 2px solid #3498db;
        padding-bottom: 10px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    table thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    table th {
        padding: 15px;
        text-align: left;
        font-weight: 600;
    }

    table td {
        padding: 12px 15px;
        border-bottom: 1px solid #ecf0f1;
    }

    table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: #d4edda;
        color: #155724;
    }

    .badge-danger {
        background: #f8d7da;
        color: #721c24;
    }

    .badge-warning {
        background: #fff3cd;
        color: #856404;
    }

    .badge-info {
        background: #d1ecf1;
        color: #0c5460;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7f8c8d;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 30px;
    }

    @media (max-width: 768px) {
        .filter-row {
            grid-template-columns: 1fr;
        }

        .stats-summary {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')
<div class="history-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>📊 Attendance History</h1>
        <a href="{{ route('teacher.self.attendance') }}" class="btn btn-secondary">← Back</a>
    </div>

    <!-- Filters -->
    <div class="filters-card">
        <form method="GET" class="filter-row">
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input 
                    type="date" 
                    id="start_date" 
                    name="start_date" 
                    value="{{ $startDate }}"
                />
            </div>

            <div class="form-group">
                <label for="end_date">End Date</label>
                <input 
                    type="date" 
                    id="end_date" 
                    name="end_date" 
                    value="{{ $endDate }}"
                />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">🔍 Search</button>
            </div>
        </form>
    </div>

    <!-- Statistics Summary -->
    @if(isset($stats))
    <div class="stats-summary">
        <div class="summary-card present">
            <div class="summary-label">Total Present</div>
            <div class="summary-value">{{ $stats['present'] ?? 0 }}</div>
        </div>

        <div class="summary-card absent">
            <div class="summary-label">Total Absent</div>
            <div class="summary-value">{{ $stats['absent'] ?? 0 }}</div>
        </div>

        <div class="summary-card leave">
            <div class="summary-label">Total Leave</div>
            <div class="summary-value">{{ $stats['leave'] ?? 0 }}</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Attendance %</div>
            <div class="summary-value" style="color: #27ae60;">{{ $stats['attendance_percentage'] ?? 0 }}%</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Total Hours</div>
            <div class="summary-value" style="color: #3498db;">{{ number_format($stats['total_hours'] ?? 0, 1) }}</div>
        </div>

        <div class="summary-card">
            <div class="summary-label">Pending Approval</div>
            <div class="summary-value" style="color: #f39c12;">{{ $stats['pending_approval'] ?? 0 }}</div>
        </div>
    </div>
    @endif

    <!-- History Table -->
    <div class="history-card">
        <h2>📋 Details</h2>

        @if($attendances && $attendances->count() > 0)
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Duration (Hours)</th>
                            <th>Approval</th>
                            <th>Reason / Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $record)
                            <tr>
                                <td>
                                    <strong>{{ $record->date->format('d M Y') }}</strong>
                                </td>
                                <td>
                                    @if($record->status === 'present')
                                        <span class="badge badge-success">✓ Present</span>
                                    @elseif($record->status === 'absent')
                                        <span class="badge badge-danger">✗ Absent</span>
                                    @else
                                        <span class="badge badge-warning">~ Leave</span>
                                    @endif
                                </td>
                                <td>{{ $record->time_in ? $record->time_in->format('H:i') : '-' }}</td>
                                <td>{{ $record->time_out ? $record->time_out->format('H:i') : '-' }}</td>
                                <td>
                                    @if($record->duration_minutes)
                                        <strong>{{ number_format($record->duration_minutes / 60, 1) }}</strong>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($record->approval_status === 'approved')
                                        <span class="badge badge-success">✓ Approved</span>
                                    @elseif($record->approval_status === 'rejected')
                                        <span class="badge badge-danger">✗ Rejected</span>
                                    @else
                                        <span class="badge badge-warning">⏳ Pending</span>
                                    @endif
                                </td>
                                <td>
                                    @if($record->approval_status === 'rejected' && $record->remarks)
                                        <small title="{{ $record->remarks }}">
                                            {{ Str::limit($record->remarks, 30) }}
                                        </small>
                                    @elseif($record->notes)
                                        <small title="{{ $record->notes }}">
                                            {{ Str::limit($record->notes, 30) }}
                                        </small>
                                    @else
                                        <small>-</small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>No attendance records found for this period</p>
            </div>
        @endif
    </div>
</div>
@endsection
