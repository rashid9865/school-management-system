@extends('users.admin.layout')

@section('title')
Admins
@endsection

@section('content')
<div class="panel-card" style="max-width:1180px; margin:2rem auto; padding:2rem; background:#fff; border-radius:24px; box-shadow:0 20px 45px rgba(41,50,57,0.08);">
    <div class="panel-header" style="display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; margin-bottom:1.5rem;">
        <div>
            <p class="eyebrow" style="margin:0; color:#6b7280; font-size:.95rem; letter-spacing:.04em; text-transform:uppercase;">Admins</p>
            <h2 style="margin:.4rem 0 0; color:#111827;">Administrator users</h2>
            <p style="margin:.6rem 0 0; color:#4b5563;">View all admin accounts and basic contact information.</p>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="data-table" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc; text-align:left;">
                    <th style="padding:1rem; color:#4b5563;">Name</th>
                    <th style="padding:1rem; color:#4b5563;">Email</th>
                    <th style="padding:1rem; color:#4b5563;">Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $admin)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:1rem;">{{ $admin->name }}</td>
                    <td style="padding:1rem;">{{ $admin->email }}</td>
                    <td style="padding:1rem;">{{ $admin->created_at?->format('d M, Y') ?? 'N/A' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding:1.5rem; text-align:center; color:#6b7280;">No admin users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
