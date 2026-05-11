@extends('users.admin.layout')

@section('title')
Fee Reports
@endsection

@section('content')
<div class="panel-card" style="max-width: 1180px; margin: 2rem auto; padding: 2rem; background: #ffffff; border-radius: 24px; box-shadow: 0 20px 45px rgba(41, 50, 57, 0.08);">
    <div class="panel-header" style="display:flex; justify-content:space-between; gap:1rem; align-items:flex-start; margin-bottom:1.5rem;">
        <div>
            <p class="eyebrow" style="margin:0; color:#6b7280; font-size:.95rem; letter-spacing:.04em; text-transform:uppercase;">Fee reports</p>
            <h2 style="margin:.4rem 0 0; color:#111827;">Fee payment overview</h2>
            <p style="margin:.6rem 0 0; color:#4b5563;">Track all fee transactions and payment statuses.</p>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="data-table" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc; text-align:left;">
                    <th style="padding:1rem; color:#4b5563;">Student</th>
                    <th style="padding:1rem; color:#4b5563;">Class</th>
                    <th style="padding:1rem; color:#4b5563;">Amount</th>
                    <th style="padding:1rem; color:#4b5563;">Due date</th>
                    <th style="padding:1rem; color:#4b5563;">Status</th>
                    <th style="padding:1rem; color:#4b5563;">Rule</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fees as $fee)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:1rem;">{{ $fee->student->user->name ?? 'N/A' }}</td>
                    <td style="padding:1rem;">{{ $fee->student->grade?->name ?? 'N/A' }}</td>
                    <td style="padding:1rem;">₹{{ number_format($fee->amount, 2) }}</td>
                    <td style="padding:1rem;">{{ optional($fee->due_date)->format('d M, Y') ?? 'N/A' }}</td>
                    <td style="padding:1rem; font-weight:700; color: {{ $fee->status === 'paid' ? '#16a34a' : '#dc2626' }};">{{ ucfirst($fee->status) }}</td>
                    <td style="padding:1rem;">{{ $fee->feeStructure?->type ? ucfirst(str_replace('_', ' ', $fee->feeStructure->type)) : 'Custom' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:1.5rem; text-align:center; color:#6b7280;">No fee records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
