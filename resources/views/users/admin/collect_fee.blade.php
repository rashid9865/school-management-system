@extends('users.admin.layout')

@section('title')
Collect Fee
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

.collect-page {
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

.collect-card {
    width: 100%;
    max-width: 1200px;
    background: var(--surface);
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 35px 90px rgba(15, 23, 42, 0.16);
    border: 1px solid rgba(59, 130, 246, 0.18);
}

.collect-card-header {
    padding: 36px 42px 28px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    display: flex;
    justify-content: space-between;
    gap: 24px;
    align-items: flex-start;
}

.collect-card-title {
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

.collect-card-header h1 {
    margin: 0;
    font-size: clamp(2rem, 2.5vw, 2.8rem);
    line-height: 1.05;
}

.collect-card-header p {
    margin: 18px 0 0;
    color: rgba(255, 255, 255, 0.88);
    line-height: 1.7;
}

.collect-badge {
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

.collect-card-body {
    padding: 36px 42px 42px;
    background: var(--surface-soft);
}

.alert {
    padding: 16px 18px;
    border-radius: 18px;
    margin-bottom: 24px;
    font-size: 0.95rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.alert-success {
    background: #ecfdf5;
    border: 1px solid #bbf7d0;
    color: var(--success);
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

.action-buttons {
    display: flex;
    gap: 0.5rem;
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
}

.btn-success {
    background: var(--success);
    color: white;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(22, 163, 74, 0.4);
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
    .collect-card {
        margin: 0 18px;
    }

    .collect-card-header,
    .collect-card-body {
        padding-left: 24px;
        padding-right: 24px;
    }

    .collect-card-header {
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
    .collect-card-header h1 {
        font-size: 2rem;
    }
}
</style>
@endsection

@section('content')
<div class="collect-page">
    <div class="collect-card">
        <div class="collect-card-header">
            <div class="collect-card-title">
                <span class="eyebrow">Fee collection</span>
                <h1>Collect Fees</h1>
                <p>Manage and collect pending fees from students</p>
            </div>
            <span class="collect-badge">{{ $pendingFees->count() }} pending</span>
        </div>
        <div class="collect-card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <div>{{ session('success') }}</div>
                </div>
            @endif

            @if($pendingFees->isEmpty())
                <div class="no-records">
                    <i class="fas fa-money-bill-wave"></i>
                    <p>No pending fees available.</p>
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
                                <th><i class="fas fa-cogs me-1"></i>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pendingFees as $fee)
                            <tr>
                                <td>{{ $fee->student->user->name ?? 'Student' }}</td>
                                <td>{{ $fee->student->grade?->name ?? 'N/A' }}</td>
                                <td><strong>₹{{ number_format($fee->amount, 2) }}</strong></td>
                                <td>{{ optional($fee->due_date)->format('d M, Y') ?? 'N/A' }}</td>
                                <td><span style="color:var(--danger); font-weight:600;">{{ ucfirst($fee->status) }}</span></td>
                                <td>
                                    <form action="{{ route('fee.collect.store', $fee->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i>Mark Paid</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">
                                    <div class="no-records">No pending fees available.</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
