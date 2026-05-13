@extends('users.admin.layout')

@section('title')
Pending Fees
@endsection

@section('css')
<style>
:root {
    color-scheme: light;
    --bg: #eaf5ff;
    --surface: #ffffff;
    --surface-soft: #f8fbff;
    --border: #cfe0ff;
    --text: #0f172a;
    --muted: #475569;
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --success: #16a34a;
    --danger: #dc2626;
}

.pending-page {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px 0 70px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: calc(100vh - 130px);
    background: linear-gradient(180deg, #eaf5ff 0%, #f9fbff 55%, #ffffff 100%);
    color: var(--text);
}

.pending-card {
    width: 100%;
    max-width: 1200px;
    background: var(--surface);
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 35px 90px rgba(15, 23, 42, 0.16);
    border: 1px solid rgba(59, 130, 246, 0.18);
}

.pending-card-header {
    padding: 36px 42px 28px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    display: flex;
    justify-content: space-between;
    gap: 24px;
    align-items: flex-start;
}

.pending-card-title {
    max-width: 72%;
}

.eyebrow {
    display: inline-block;
    margin-bottom: 16px;
    font-size: 0.85rem;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    opacity: 0.9;
}

.pending-card-header h1 {
    margin: 0;
    font-size: clamp(2rem, 2.5vw, 2.8rem);
    line-height: 1.05;
}

.pending-card-header p {
    margin: 18px 0 0;
    color: rgba(255, 255, 255, 0.88);
    line-height: 1.7;
}

.pending-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 18px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.18);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.92rem;
    white-space: nowrap;
}

.pending-card-body {
    padding: 36px 42px 42px;
    background: var(--surface-soft);
}

.data-table-container {
    background: var(--surface);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
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
    border-bottom: 1px solid var(--border);
}

.data-table tr:hover td {
    background: var(--surface-soft);
}

.data-table tr:last-child td {
    border-bottom: none;
}

.no-records {
    text-align: center;
    padding: 3rem;
    color: var(--muted);
    background: var(--surface);
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
}

.no-records i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.3;
}

@media (max-width: 720px) {
    .pending-card {
        margin: 0 18px;
    }

    .pending-card-header,
    .pending-card-body {
        padding-left: 24px;
        padding-right: 24px;
    }

    .pending-card-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .data-table-container {
        padding: 1.5rem;
    }

    .data-table th,
    .data-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
    }
}

@media (max-width: 520px) {
    .pending-card-header h1 {
        font-size: 2rem;
    }
}
</style>
@endsection

@section('content')
<div class="pending-page">
    <div class="pending-card">
        <div class="pending-card-header">
            <div class="pending-card-title">
                <span class="eyebrow">Fee monitoring</span>
                <h1>Pending Fees</h1>
                <p>View all unpaid and pending fee records from students</p>
            </div>
            <span class="pending-badge">{{ $pendingFees->count() }} pending</span>
        </div>
        <div class="pending-card-body">
            @if($pendingFees->isEmpty())
                <div class="no-records">
                    <i class="fas fa-check-circle"></i>
                    <p>No unpaid fee records found.</p>
                </div>
            @else
                <div class="data-table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user me-1"></i>Student</th>
                                <th><i class="fas fa-book me-1"></i>Class</th>
                                <th><i class="fas fa-indian-rupee-sign me-1"></i>Amount</th>
                                <th><i class="fas fa-calendar me-1"></i>Due Date</th>
                                <th><i class="fas fa-info-circle me-1"></i>Status</th>
                                <th><i class="fas fa-file me-1"></i>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingFees as $fee)
                            <tr>
                                <td>{{ $fee->student->user->name ?? 'Student' }}</td>
                                <td>{{ $fee->student->grade?->name ?? 'N/A' }}</td>
                                <td><strong>₹{{ number_format($fee->amount, 2) }}</strong></td>
                                <td>{{ optional($fee->due_date)->format('d M, Y') ?? 'N/A' }}</td>
                                <td><span style="color:var(--danger); font-weight:600;">{{ ucfirst($fee->status) }}</span></td>
                                <td>{{ $fee->feeStructure?->description ?? '—' }}</td>
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
