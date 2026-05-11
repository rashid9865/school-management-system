@extends('users.admin.layout')

@section('title')
Permissions
@endsection

@section('content')
<div class="panel-card" style="max-width:1180px; margin:2rem auto; padding:2rem; background:#fff; border-radius:24px; box-shadow:0 20px 45px rgba(41,50,57,0.08);">
    <div class="panel-header" style="display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; margin-bottom:1.5rem;">
        <div>
            <p class="eyebrow" style="margin:0; color:#6b7280; font-size:.95rem; letter-spacing:.04em; text-transform:uppercase;">Permissions</p>
            <h2 style="margin:.4rem 0 0; color:#111827;">Role-based permissions</h2>
            <p style="margin:.6rem 0 0; color:#4b5563;">Review the permissions assigned to each role in the system.</p>
        </div>
    </div>

    <div style="display:grid; gap:1.5rem; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr));">
        @foreach($permissions as $role => $capabilities)
        <div style="padding:1.5rem; border-radius:20px; background:#f8fafc; border:1px solid #e5e7eb;">
            <h3 style="margin:0 0 1rem; color:#111827; text-transform:capitalize;">{{ $role }}</h3>
            <ul style="margin:0; padding-left:1.25rem; color:#4b5563; line-height:1.8;">
                @foreach($capabilities as $permission)
                <li>{{ $permission }}</li>
                @endforeach
            </ul>
        </div>
        @endforeach
    </div>
</div>
@endsection
