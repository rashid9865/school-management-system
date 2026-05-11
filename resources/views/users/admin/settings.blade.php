@extends('users.admin.layout')

@section('title')
Settings
@endsection

@section('content')
<div class="panel-card" style="max-width:1180px; margin:2rem auto; padding:2rem; background:#fff; border-radius:24px; box-shadow:0 20px 45px rgba(41,50,57,0.08);">
    <div class="panel-header" style="display:flex; justify-content:space-between; align-items:flex-start; gap:1rem; margin-bottom:1.5rem;">
        <div>
            <p class="eyebrow" style="margin:0; color:#6b7280; font-size:.95rem; letter-spacing:.04em; text-transform:uppercase;">Settings</p>
            <h2 style="margin:.4rem 0 0; color:#111827;">School information</h2>
            <p style="margin:.6rem 0 0; color:#4b5563;">Update your school name, contact details and logo from one page.</p>
        </div>
    </div>

    @if(session('success'))
    <div style="margin-bottom:1.5rem; padding:1rem; border-radius:12px; background:#ecfdf5; color:#166534; border:1px solid #d1fae5;">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display:grid; gap:1.5rem; grid-template-columns:1fr 360px;">
            <div style="display:grid; gap:1rem;">
                <div style="display:grid; gap:.55rem;">
                    <label for="school_name" style="font-weight:600; color:#111827;">School name</label>
                    <input type="text" name="school_name" id="school_name" value="{{ old('school_name', $setting->school_name ?? '') }}" style="width:100%; border:1px solid #d1d5db; border-radius:14px; padding:.95rem 1rem;" placeholder="Enter school name">
                </div>

                <div style="display:grid; gap:.55rem;">
                    <label for="school_email" style="font-weight:600; color:#111827;">School email</label>
                    <input type="email" name="school_email" id="school_email" value="{{ old('school_email', $setting->school_email ?? '') }}" style="width:100%; border:1px solid #d1d5db; border-radius:14px; padding:.95rem 1rem;" placeholder="admin@school.com">
                </div>

                <div style="display:grid; gap:.55rem;">
                    <label for="school_phone" style="font-weight:600; color:#111827;">Contact phone</label>
                    <input type="text" name="school_phone" id="school_phone" value="{{ old('school_phone', $setting->school_phone ?? '') }}" style="width:100%; border:1px solid #d1d5db; border-radius:14px; padding:.95rem 1rem;" placeholder="+92 300 1234567">
                </div>

                <div style="display:grid; gap:.55rem;">
                    <label for="school_address" style="font-weight:600; color:#111827;">School address</label>
                    <textarea name="school_address" id="school_address" rows="4" style="width:100%; border:1px solid #d1d5db; border-radius:14px; padding:1rem;">{{ old('school_address', $setting->school_address ?? '') }}</textarea>
                </div>

                <div style="display:flex; justify-content:flex-end;">
                    <button type="submit" style="background:#4338ca; color:#fff; border:none; padding:.95rem 1.4rem; border-radius:999px; cursor:pointer;">Save settings</button>
                </div>
            </div>

            <div style="padding:1.5rem; border-radius:20px; background:#f8fafc; border:1px solid #e5e7eb; display:grid; gap:1rem;">
                <div>
                    <h3 style="margin:0 0 .75rem; color:#111827;">School logo</h3>
                    <p style="margin:0; color:#6b7280;">Upload the school logo that appears on the dashboard and reports.</p>
                </div>
                @if(!empty($setting->logo_path))
                <div style="max-width:240px; border-radius:16px; overflow:hidden; background:#fff; border:1px solid #e5e7eb;">
                    <img src="{{ asset('storage/' . $setting->logo_path) }}" alt="School logo" style="width:100%; display:block;">
                </div>
                @endif
                <div style="display:grid; gap:.55rem;">
                    <label for="logo_path" style="font-weight:600; color:#111827;">Upload logo</label>
                    <input type="file" name="logo_path" id="logo_path" accept="image/*" style="padding:.5rem; border-radius:14px; border:1px solid #d1d5db; background:#fff;">
                </div>
                <p style="margin:0; color:#6b7280; font-size:.95rem;">Recommended size 300×300px, JPG/PNG only.</p>
            </div>
        </div>
    </form>
</div>
@endsection
