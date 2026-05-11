@extends('users.admin.layout')

@section('title')
Teacher Attendance Approvals
@endsection

@section('css')
<style>
    .approval-container {
        padding: 20px;
        max-width: 1400px;
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

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        border-top: 4px solid #3498db;
    }

    .stat-card.warning {
        border-top-color: #f39c12;
    }

    .stat-number {
        font-size: 36px;
        font-weight: bold;
        color: #2c3e50;
        margin: 10px 0;
    }

    .stat-label {
        font-size: 13px;
        color: #7f8c8d;
    }

    .table-card {
        background: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .table-card h2 {
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
        padding: 15px;
        border-bottom: 1px solid #ecf0f1;
    }

    table tbody tr {
        transition: background-color 0.2s ease;
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

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 8px 15px;
        border: none;
        border-radius: 5px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-approve {
        background: #27ae60;
        color: white;
    }

    .btn-approve:hover {
        background: #229954;
        transform: translateY(-2px);
    }

    .btn-reject {
        background: #e74c3c;
        color: white;
    }

    .btn-reject:hover {
        background: #c0392b;
        transform: translateY(-2px);
    }

    .btn-view {
        background: #3498db;
        color: white;
    }

    .btn-view:hover {
        background: #2980b9;
    }

    /* Modal Styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        animation: fadeIn 0.3s ease;
    }

    .modal.show {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        max-width: 500px;
        width: 90%;
        animation: slideIn 0.3s ease;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        border-bottom: 2px solid #ecf0f1;
        padding-bottom: 15px;
    }

    .modal-header h2 {
        margin: 0;
        color: #2c3e50;
    }

    .close-btn {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #7f8c8d;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 8px;
        color: #2c3e50;
    }

    .form-group textarea {
        width: 100%;
        padding: 12px;
        border: 2px solid #ecf0f1;
        border-radius: 5px;
        font-family: inherit;
        resize: vertical;
        min-height: 100px;
    }

    .form-group textarea:focus {
        outline: none;
        border-color: #3498db;
    }

    .modal-actions {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
        margin-top: 30px;
    }

    .btn-cancel {
        background: #95a5a6;
        color: white;
        padding: 10px 20px;
    }

    .btn-cancel:hover {
        background: #7f8c8d;
    }

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

    .info-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 5px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 12px;
        color: #7f8c8d;
        margin-bottom: 5px;
    }

    .info-value {
        font-weight: 600;
        color: #2c3e50;
    }

    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }

        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')
<div class="approval-container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>✓ Teacher Attendance Approvals</h1>
        <span class="badge badge-warning">{{ $pendingAttendances->count() }} Pending</span>
    </div>

    <!-- Statistics -->
    <div class="stats-grid">
        <div class="stat-card warning">
            <div class="stat-label">Pending Approval</div>
            <div class="stat-number">{{ $pendingAttendances->count() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Unique Teachers</div>
            <div class="stat-number">{{ $pendingAttendances->groupBy('teacher_id')->count() }}</div>
        </div>
    </div>

    <!-- Pending Approvals Table -->
    <div class="table-card">
        <h2>📋 Pending for Approval</h2>

        @if($pendingAttendances->count() > 0)
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th>Duration</th>
                            <th>Notes</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingAttendances as $record)
                            <tr>
                                <td>
                                    <strong>{{ $record->teacher->user->name ?? 'N/A' }}</strong><br>
                                    <small>ID: {{ $record->teacher->id ?? 'N/A' }}</small>
                                </td>
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
                                <td>
                                    @if($record->time_in && $record->time_out)
                                        {{ $record->time_in->format('H:i') }} - {{ $record->time_out->format('H:i') }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($record->duration_minutes)
                                        <strong>{{ number_format($record->duration_minutes / 60, 1) }} hrs</strong>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($record->notes)
                                        <small title="{{ $record->notes }}">{{ Str::limit($record->notes, 30) }}</small>
                                    @else
                                        <small>-</small>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-approve" onclick="openApprovalModal({{ $record->id }})">
                                            ✓ Approve
                                        </button>
                                        <button class="btn btn-reject" onclick="openRejectionModal({{ $record->id }})">
                                            ✗ Reject
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
                <i class="fas fa-check-circle"></i>
                <p>No pending approvals at this time</p>
            </div>
        @endif
    </div>
</div>

<!-- Approval Modal -->
<div id="approvalModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>✓ Approve Attendance</h2>
            <button class="close-btn" onclick="closeApprovalModal()">×</button>
        </div>
        <form id="approvalForm" method="POST" action="">
            @csrf
            <input type="hidden" name="approval_status" value="approved">

            <div class="form-group">
                <label>Notes (Optional)</label>
                <textarea name="remarks" placeholder="Add any notes..."></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeApprovalModal()">Cancel</button>
                <button type="submit" class="btn btn-approve">✓ Approve</button>
            </div>
        </form>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectionModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>✗ Reject Attendance</h2>
            <button class="close-btn" onclick="closeRejectionModal()">×</button>
        </div>
        <form id="rejectionForm" method="POST" action="">
            @csrf
            <input type="hidden" name="approval_status" value="rejected">

            <div class="form-group">
                <label>Reason for Rejection *</label>
                <textarea name="remarks" placeholder="Please provide reason for rejection..." required></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn btn-cancel" onclick="closeRejectionModal()">Cancel</button>
                <button type="submit" class="btn btn-reject">✗ Reject</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openApprovalModal(attendanceId) {
        document.getElementById('approvalForm').action = `/teacher-attendance/${attendanceId}/approve`;
        document.getElementById('approvalModal').classList.add('show');
    }

    function closeApprovalModal() {
        document.getElementById('approvalModal').classList.remove('show');
    }

    function openRejectionModal(attendanceId) {
        document.getElementById('rejectionForm').action = `/teacher-attendance/${attendanceId}/approve`;
        document.getElementById('rejectionModal').classList.add('show');
    }

    function closeRejectionModal() {
        document.getElementById('rejectionModal').classList.remove('show');
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const approvalModal = document.getElementById('approvalModal');
        const rejectionModal = document.getElementById('rejectionModal');
        
        if (event.target === approvalModal) {
            closeApprovalModal();
        }
        if (event.target === rejectionModal) {
            closeRejectionModal();
        }
    });

    // Close on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeApprovalModal();
            closeRejectionModal();
        }
    });
</script>
@endsection
