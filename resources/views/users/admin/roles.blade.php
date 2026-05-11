@extends('users.admin.layout')

@section('title')
Roles
@endsection

@section('content')
<div class="panel-card" style="max-width:1180px; margin:2rem auto; padding:2rem; background:#fff; border-radius:24px; box-shadow:0 20px 45px rgba(41,50,57,0.08);">
    <div class="panel-header" style="display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; margin-bottom:1.5rem;">
        <div>
            <p class="eyebrow" style="margin:0; color:#6b7280; font-size:.95rem; letter-spacing:.04em; text-transform:uppercase;">Roles</p>
            <h2 style="margin:.4rem 0 0; color:#111827;">User role management</h2>
            <p style="margin:.6rem 0 0; color:#4b5563;">Review current role assignments and update user roles directly.</p>
        </div>
    </div>

    @if(session('success'))
    <div style="margin-bottom:1.5rem; padding:1rem; border-radius:12px; background:#ecfdf5; color:#166534; border:1px solid #d1fae5;">
        {{ session('success') }}
    </div>
    @endif

    <div style="margin-bottom:2rem; display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:1rem;">
        @foreach($roles as $key => $label)
        <div style="padding:1.2rem; border-radius:18px; background:#f8fafc; border:1px solid #e5e7eb;">
            <h3 style="margin:0 0 .5rem; color:#111827;">{{ $label }}</h3>
            <p style="margin:0; color:#6b7280; font-size:.95rem;">{{ $roleCounts[$key] ?? 0 }} users</p>
        </div>
        @endforeach
    </div>

    <div style="overflow-x:auto;">
        <table class="data-table" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc; text-align:left;">
                    <th style="padding:1rem; color:#4b5563;">Name</th>
                    <th style="padding:1rem; color:#4b5563;">Email</th>
                    <th style="padding:1rem; color:#4b5563;">Current role</th>
                    <th style="padding:1rem; color:#4b5563;">Change role</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr style="border-bottom:1px solid #e5e7eb;">
                    <td style="padding:1rem;">{{ $user->name }}</td>
                    <td style="padding:1rem;">{{ $user->email }}</td>
                    <td style="padding:1rem;">{{ ucfirst($user->role) }}</td>
                    <td style="padding:1rem;">
                        <form action="{{ route('admin.users.role.update', $user->id) }}" method="POST" style="display:flex; gap:.75rem; align-items:center; flex-wrap:wrap;">
                            @csrf
                            @method('PUT')
                            <select name="role" style="padding:.75rem 1rem; border:1px solid #d1d5db; border-radius:12px; background:#fff;">
                                @foreach($roles as $roleKey => $roleLabel)
                                <option value="{{ $roleKey }}" {{ $user->role === $roleKey ? 'selected' : '' }}>{{ $roleLabel }}</option>
                                @endforeach
                            </select>
                            <button type="submit" style="background:#4338ca; color:#fff; border:none; padding:.75rem 1.2rem; border-radius:999px; cursor:pointer;">Save</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding:1.5rem; text-align:center; color:#6b7280;">No users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
