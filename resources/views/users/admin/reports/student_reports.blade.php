@extends('users.admin.layout')

@section('title')
Student Reports
@endsection

@section('content')
<div class="panel-card" style="max-width: 1180px; margin: 2rem auto; padding: 2rem; background: #ffffff; border-radius: 24px; box-shadow: 0 20px 45px rgba(41, 50, 57, 0.08);">
    <div class="panel-header" style="display:flex; justify-content:space-between; gap:1rem; align-items:flex-start; margin-bottom:1.5rem;">
        <div>
            <p class="eyebrow" style="margin:0; color:#6b7280; font-size:.95rem; letter-spacing:.04em; text-transform:uppercase;">Student reports</p>
            <h2 style="margin:.4rem 0 0; color:#111827;">All student records</h2>
            <p style="margin:.6rem 0 0; color:#4b5563;">Review student profiles, class assignment, and contact details from one place.</p>
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="data-table" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc; text-align:left;">
                    <th style="padding:1rem; color:#4b5563;">Name</th>
                    <th style="padding:1rem; color:#4b5563;">Email</th>
                    <th style="padding:1rem; color:#4b5563;">Class</th>
                    <th style="padding:1rem; color:#4b5563;">Section</th>
                    <th style="padding:1rem; color:#4b5563;">Roll No</th>
                    <th style="padding:1rem; color:#4b5563;">Phone</th>
                    <th style="padding:1rem; color:#4b5563;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:1rem;">{{ $student->user->name ?? 'N/A' }}</td>
                    <td style="padding:1rem;">{{ $student->user->email ?? 'N/A' }}</td>
                    <td style="padding:1rem;">{{ $student->grade?->name ?? 'N/A' }}</td>
                    <td style="padding:1rem;">{{ $student->section?->name ?? 'N/A' }}</td>
                    <td style="padding:1rem;">{{ $student->roll_no ?? 'N/A' }}</td>
                    <td style="padding:1rem;">{{ $student->user->phone ?? 'N/A' }}</td>
                    <td style="padding:1rem; color:#4b5563;">Active</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding:1.5rem; text-align:center; color:#6b7280;">No student records found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
