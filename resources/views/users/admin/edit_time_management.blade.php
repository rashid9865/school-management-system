@extends('users.admin.layout')

@section('title')
Edit Time Slot
@endsection

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<style>
    .auth-page {
        min-height: calc(100vh - 130px);
    }

    .auth-card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .submit_button {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .submit_button:hover {
        box-shadow: 0 18px 40px rgba(102, 126, 234, 0.3);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .auth-badge i {
        font-size: 1.5rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .cancel-btn {
        flex: 1;
        padding: 16px 0;
        border: 2px solid #e5e7eb;
        border-radius: 20px;
        background: white;
        color: #6b7280;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .cancel-btn:hover {
        border-color: #d1d5db;
        background: #f9fafb;
    }

    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions button,
        .form-actions a {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="auth-page">
    <div class="auth-card">

        {{-- Header --}}
        <div class="auth-card-header">

            <div class="auth-card-title">

                <span class="eyebrow">
                    Time Slot Management
                </span>

                <h1>Edit Time Slot</h1>

                <p>
                    Update time period settings for class schedules.
                </p>

            </div>

            <div class="auth-badge">
                <i class="fas fa-edit"></i>
            </div>

        </div>

        {{-- Body --}}
        <div class="auth-card-body">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Form --}}
            <form action="{{ route('time-management.update', $timeManagements->id) }}" method="POST" autocomplete="off">

                @csrf
                @method('PUT')

                <div class="form-grid">

                    {{-- Date --}}
                    <div class="form-group">
                        <label for="date">Date</label>

                        <input type="date"
                               id="date"
                               name="date"
                               value="{{ old('date', $timeManagements->date) }}">
                    </div>

                    {{-- Day --}}
                    <div class="form-group">
                        <label for="day">Day</label>

                        <input type="text"
                               id="day"
                               name="day"
                               placeholder="e.g., Monday"
                               value="{{ old('day', $timeManagements->day) }}"
                               required>
                    </div>

                    {{-- Start Time --}}
                    <div class="form-group">
                        <label for="start_time">Start Time</label>

                        <input type="time"
                               id="start_time"
                               name="start_time"
                               value="{{ old('start_time', $timeManagements->start_time) }}"
                               required>
                    </div>

                    {{-- End Time --}}
                    <div class="form-group">
                        <label for="end_time">End Time</label>

                        <input type="time"
                               id="end_time"
                               name="end_time"
                               value="{{ old('end_time', $timeManagements->end_time) }}"
                               required>
                    </div>

                    {{-- Period Duration --}}
                    <div class="form-group" style="grid-column: 1 / -1;">
                        <label for="period_minutes">Period Duration (minutes)</label>

                        <input type="number"
                               id="period_minutes"
                               name="period_minutes"
                               placeholder="e.g., 60"
                               min="1"
                               value="{{ old('period_minutes', $timeManagements->period_minutes ?? 60) }}"
                               required>
                        <small style="color: #6b7280; margin-top: 0.5rem; display: block;">How many minutes should each period last?</small>
                    </div>

                </div>

                {{-- Form Actions --}}
                <div class="form-actions">
                    <button type="submit" class="submit_button">
                        <i class="fas fa-save me-2"></i>Update Time Slot
                    </button>
                    <a href="{{ route('time-management.index') }}" class="cancel-btn">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>

            </form>

            <p class="meta-text">
                Update the time slot settings as needed.
            </p>

        </div>
    </div>
</div>
@endsection
