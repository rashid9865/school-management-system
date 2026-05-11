@extends('users.student.layout')

@section('title')
Fees
@endsection

@section('css')
<link href="{{ asset('css/student/fees.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="fees-container">
    <header class="fees-header">
        <div>
            <h1>Fee Details</h1>
            <p class="fees-subtitle">Track your due fees, payment status, and fee structure in one place.</p>
        </div>
    </header>

    <section class="fees-card">
        <div class="fees-summary">
            <div>
                <span>Total balance</span>
                <strong>{{ number_format($fees->sum('amount') ?: ($feeStructure?->amount ?? 0), 2) }}</strong>
            </div>
            <div>
                <span>Unpaid</span>
                <strong>{{ number_format($fees->where('status', 'unpaid')->sum('amount') ?: ($feeStructure?->amount ?? 0), 2) }}</strong>
            </div>
            <div>
                <span>Paid</span>
                <strong>{{ number_format($fees->where('status', 'paid')->sum('amount'), 2) }}</strong>
            </div>
        </div>

        <div class="fees-table-wrap">
            <table class="fees-table">
                <thead>
                    <tr>
                        <th>Amount</th>
                        <th>Due date</th>
                        <th>Status</th>
                        <th>Structure</th>
                    </tr>
                </thead>
                <tbody>
                    @if($fees->isEmpty() && $feeStructure)
                        <tr>
                            <td>{{ number_format($feeStructure->amount, 2) }}</td>
                            <td>—</td>
                            <td><span class="fee-status fee-status-unpaid">Unpaid</span></td>
                            <td>{{ $feeStructure->description ?? ucfirst(str_replace('_', ' ', $feeStructure->type)) }}</td>
                        </tr>
                    @else
                        @forelse($fees as $fee)
                            <tr>
                                <td>{{ number_format($fee->amount, 2) }}</td>
                                <td>{{ $fee->due_date }}</td>
                                <td><span class="fee-status fee-status-{{ strtolower($fee->status) }}">{{ ucfirst($fee->status) }}</span></td>
                                <td>{{ $fee->feeStructure?->description ?? ucfirst(str_replace('_', ' ', $fee->feeStructure?->type ?? 'class fee')) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="fees-empty">No fees found.</td>
                            </tr>
                        @endforelse
                    @endif
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection