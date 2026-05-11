@extends('users.admin.layout')

@section('title')
Pending Fees
@endsection

@section('content')
<div class="panel-card" style="max-width: 1180px; margin: 2rem auto; padding: 2rem; background: #ffffff; border-radius: 24px; box-shadow: 0 20px 45px rgba(41, 50, 57, 0.08);">
    <div class="panel-header" style="display:flex; justify-content:space-between; gap:1rem; align-items:flex-start; margin-bottom:1.5rem;">
        <div>
            <p class="eyebrow" style="margin:0; color:#6b7280; font-size:.95rem; letter-spacing:.04em; text-transform:uppercase;">Pending fees</p>
            <h2 style="margin:.4rem 0 0; color:#111827;">Unpaid fee records</h2>
            <p style="margin:.6rem 0 0; color:#4b5563;">Review all unpaid fee transactions and follow up on outstanding balances.</p>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="data-table" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc; text-align:left;">
                    <th style="padding:1rem; color:#4b5563; text-transform:uppercase; letter-spacing:.02em;">Student</th>
                    <th style="padding:1rem; color:#4b5563; text-transform:uppercase; letter-spacing:.02em;">Class</th>
                    <th style="padding:1rem; color:#4b5563; text-transform:uppercase; letter-spacing:.02em;">Amount</th>
                    <th style="padding:1rem; color:#4b5563; text-transform:uppercase; letter-spacing:.02em;">Due date</th>
                    <th style="padding:1rem; color:#4b5563; text-transform:uppercase; letter-spacing:.02em;">Status</th>
                    <th style="padding:1rem; color:#4b5563; text-transform:uppercase; letter-spacing:.02em;">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendingFees as $fee)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:1rem;">{{ $fee->student->user->name ?? 'Student' }}</td>
                    <td style="padding:1rem;">{{ $fee->student->grade?->name ?? 'N/A' }}</td>
                    <td style="padding:1rem;">₹{{ number_format($fee->amount, 2) }}</td>
                    <td style="padding:1rem;">{{ optional($fee->due_date)->format('d M, Y') ?? 'N/A' }}</td>
                    <td style="padding:1rem; color:#dc2626; font-weight:600;">{{ ucfirst($fee->status) }}</td>
                    <td style="padding:1rem; color:#4b5563;">{{ $fee->feeStructure?->description ?? '—' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:1.5rem; text-align:center; color:#6b7280;">No unpaid fee records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
