@extends('users.teacher.layout')

@section('title')
Attendance Management
@endsection

@section('css')
<style>
    .attendance-container {
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

    /* Statistics Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card.present {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .stat-card.absent {
        background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%);
    }

    .stat-card.leave {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .stat-card.pending {
        background: linear-gradient(135deg, #ffa751 0%, #ffe259 100%);
    }

    .stat-number {
        font-size: 32px;
        font-weight: bold;
        margin: 10px 0;
    }

    .stat-label {
        font-size: 14px;
        opacity: 0.9;
    }

    /* Alert Messages */
    .alert {
        padding: 15px 20px;
        border-radius: 5px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .alert-error {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .alert-warning {
        background-color: #fff3cd;
        border: 1px solid #ffeeba;
        color: #856404;
    }

    .alert i {
        margin-right: 10px;
        font-size: 18px;
    }

    /* Form Card */
    .form-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .form-card h2 {
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 25px;
        border-bottom: 2px solid #3498db;
        padding-bottom: 10px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
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
    .form-group select,
    .form-group textarea {
        padding: 12px;
        border: 2px solid #ecf0f1;
        border-radius: 5px;
        font-size: 14px;
        font-family: inherit;
        transition: border-color 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 100px;
    }

    .error-text {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
    }

    /* Buttons */
    .btn {
        padding: 12px 30px;
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
        width: 100%;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #95a5a6;
        color: white;
    }

    .btn-secondary:hover {
        background: #7f8c8d;
    }

    .btn-sm {
        padding: 8px 15px;
        font-size: 12px;
    }

    /* History Table */
    .history-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
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

    table tbody tr {
        transition: background-color 0.2s ease;
    }

    table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Status Badges */
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

    .badge-secondary {
        background: #e2e3e5;
        color: #383d41;
    }

    /* Today Status */
    .today-status {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .today-status h3 {
        margin: 0;
        font-size: 18px;
    }

    .today-status-value {
        font-size: 24px;
        font-weight: bold;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7f8c8d;
    }

    .empty-state i {
        font-size: 60px;
        margin-bottom: 20px;
        color: #bdc3c7;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="attendance-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>📅 Attendance Management</h1>
        @if($todayStatus)
            <div class="badge badge-success">Today's Attendance Marked</div>
        @else
            <div class="badge badge-warning">Mark Today's Attendance</div>
        @endif
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Statistics Dashboard -->
    @if(isset($stats))
    <div class="stats-grid">
        <div class="stat-card present">
            <div class="stat-label">Present</div>
            <div class="stat-number">{{ $stats['present'] ?? 0 }}</div>
            <div class="stat-label">Days</div>
        </div>

        <div class="stat-card absent">
            <div class="stat-label">Absent</div>
            <div class="stat-number">{{ $stats['absent'] ?? 0 }}</div>
            <div class="stat-label">Days</div>
        </div>

        <div class="stat-card leave">
            <div class="stat-label">Leave</div>
            <div class="stat-number">{{ $stats['leave'] ?? 0 }}</div>
            <div class="stat-label">Days</div>
        </div>

        <div class="stat-card pending">
            <div class="stat-label">Pending Approval</div>
            <div class="stat-number">{{ $stats['pending_approval'] ?? 0 }}</div>
            <div class="stat-label">Records</div>
        </div>
    </div>
    @endif

    <!-- Mark Attendance Form -->
    <div class="form-card">
        <h2>📝 Mark Attendance</h2>

        @if($todayStatus)
            <div class="alert alert-warning">
                <i class="fas fa-info-circle"></i>
                You have already marked attendance on {{ $todayStatus->date->format('d M Y') }}. Status: <strong>{{ ucfirst($todayStatus->status) }}</strong>
            </div>
        @else
            <form action="{{ route('teacher.self.attendance.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label for="date">Date *</label>
                        <input 
                            type="date" 
                            id="date" 
                            name="date" 
                            value="{{ old('date', now()->format('Y-m-d')) }}" 
                            required 
                        />
                        @error('date')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status *</label>
                        <select id="status" name="status" required onchange="toggleTimeInputs()">
                            <option value="">Select Status</option>
                            <option value="present" {{ old('status') == 'present' ? 'selected' : '' }}>Present</option>
                            <option value="absent" {{ old('status') == 'absent' ? 'selected' : '' }}>Absent</option>
                            <option value="leave" {{ old('status') == 'leave' ? 'selected' : '' }}>Leave</option>
                        </select>
                        @error('status')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-row" id="timeInputsRow" style="display: none;">
                    <div class="form-group">
                        <label for="time_in">Time In (HH:MM)</label>
                        <input 
                            type="time" 
                            id="time_in" 
                            name="time_in" 
                            value="{{ old('time_in') }}" 
                        />
                        @error('time_in')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="time_out">Time Out (HH:MM)</label>
                        <input 
                            type="time" 
                            id="time_out" 
                            name="time_out" 
                            value="{{ old('time_out') }}" 
                        />
                        @error('time_out')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea 
                        id="notes" 
                        name="notes" 
                        placeholder="Add any additional notes..."
                    >{{ old('notes') }}</textarea>
                    @error('notes')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">✓ Save Attendance</button>
            </form>

            <script>
                function toggleTimeInputs() {
                    const status = document.getElementById('status').value;
                    const timeRow = document.getElementById('timeInputsRow');
                    if (status === 'present') {
                        timeRow.style.display = 'grid';
                    } else {
                        timeRow.style.display = 'none';
                    }
                }
                // Initialize on page load
                toggleTimeInputs();
            </script>
        @endif
    </div>

    <!-- Attendance History -->
    <div class="history-card">
        <h2>📊 Current Month Attendance</h2>

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
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendances as $record)
                            <tr>
                                <td>
                                    <strong>{{ $record->date->format('d M') }}</strong><br>
                                    <small>{{ $record->date->format('Y') }}</small>
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
                                        {{ number_format($record->duration_minutes / 60, 1) }}
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
                                    @if($record->notes)
                                        <small title="{{ $record->notes }}">
                                            {{ Str::limit($record->notes, 20) }}
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
                <i class="fas fa-calendar-check"></i>
                <p>No attendance records yet</p>
            </div>
        @endif
    </div>

    <!-- View Full History Button -->
    <div style="text-align: center;">
        <a href="{{ route('teacher.attendance.history') }}" class="btn btn-secondary">
            📈 View Full History
        </a>
    </div>
</div>
@endsection