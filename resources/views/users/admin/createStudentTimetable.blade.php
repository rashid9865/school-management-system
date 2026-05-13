@extends('users.admin.layout')

@section('title')
Create Student Timetable
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

    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
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
                    Timetable Management
                </span>

                <h1>Create Student Timetable</h1>

                <p>
                    Set up class schedules and assign subjects to time slots.
                </p>

            </div>

            <div class="auth-badge">
                <i class="fas fa-calendar-alt"></i>
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
            <form action="{{ route('timetable') }}" method="POST">
                @csrf

                <div class="form-grid">

                    {{-- Grade --}}
                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <select name="grade_id" id="grade">
                            <option value="">Select Grade</option>
                            @foreach($grades as $grade)
                                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Schedule --}}
                    <div class="form-group">
                        <label for="schedule">Schedule</label>
                        <select name="schedule_id" id="schedule">
                            <option value="">Select Schedule</option>
                            @foreach($timeSlots as $slot)
                                <option value="{{ $slot->id }}" data-day="{{ $slot->day }}">
                                    {{ $slot->day }} | {{ $slot->start_time }} - {{ $slot->end_time }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Day --}}
                    <div class="form-group">
                        <label for="day">Day</label>
                        <select name="day" id="day">
                            <option value="">Select Day</option>
                        </select>
                    </div>

                    {{-- Subject --}}
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <select name="subject" id="subject" disabled>
                            <option>Select schedule first</option>
                        </select>
                    </div>

                    {{-- Start Time --}}
                    <div class="form-group">
                        <label for="start_time">Start Time</label>
                        <select name="start_time" id="start_time" disabled>
                            <option>Select subject first</option>
                        </select>
                    </div>

                    {{-- End Time --}}
                    <div class="form-group">
                        <label for="end_time">End Time</label>
                        <select name="end_time" id="end_time" disabled>
                            <option>Select start time first</option>
                        </select>
                    </div>

                </div>

                {{-- Submit --}}
                <button type="submit" class="submit_button">
                    <i class="fas fa-save me-2"></i>Save Timetable
                </button>

            </form>

            <p class="meta-text">
                Select grade and schedule to automatically configure time slots and subjects.
            </p>

        </div>
    </div>
</div>
@endsection


@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const grade = document.getElementById('grade');
    const schedule = document.getElementById('schedule');
    const subject = document.getElementById('subject');
    const day = document.getElementById('day');
    const startTime = document.getElementById('start_time');
    const endTime = document.getElementById('end_time');

    function resetSubject() {
        subject.innerHTML = `<option>Select schedule first</option>`;
         subject.disabled = true;
    }

    function resetTime() {
        startTime.innerHTML = `<option>Select subject first</option>`;
        endTime.innerHTML = `<option>Select start time first</option>`;
        startTime.disabled = true;
        endTime.disabled = true;
    }

    // Schedule change
    schedule.addEventListener('change', function () {

        resetSubject();
        resetTime();

        const opt = this.options[this.selectedIndex];
        const selectedDay = opt.getAttribute('data-day') || '';

        day.innerHTML = `<option value="${selectedDay}" selected>${selectedDay}</option>`;

        if (grade.value) loadSubjects();
    });

    // Grade change
    grade.addEventListener('change', function () {
        resetSubject();
        resetTime();
        if (schedule.value) loadSubjects();
    });

    // Load subjects
    function loadSubjects() {

        fetch(`/api/available-subjects?grade_id=${grade.value}&day=${day.value}`)
            .then(res => res.json())
            .then(data => {

                subject.innerHTML = `<option value="">Select Subject</option>`;

                if (!data.length) {
                    subject.innerHTML = `<option>No subjects available</option>`;
                    subject.disabled = true;
                    return;
                }

                data.forEach(s => {
                    subject.innerHTML += `<option value="${s.name}">${s.name}</option>`;
                });

                subject.disabled = false;
            });
    }

    // Subject change
    subject.addEventListener('change', function () {

        if (!this.value) return;

        fetch(`/api/available-times?grade_id=${grade.value}&subject=${subject.value}&day=${day.value}&schedule_id=${schedule.value}`)
            .then(res => res.json())
            .then(data => {

                startTime.innerHTML = `<option value="">Select start time</option>`;
                endTime.innerHTML = `<option>Select start time first</option>`;

                data.forEach(t => {
                    startTime.innerHTML += `<option value="${t}">${t}</option>`;
                });

                startTime.disabled = false;
                endTime.disabled = true;
            });
    });

    // Start time change (FIXED LOGIC)
    startTime.addEventListener('change', function () {

        const start = this.value;

        endTime.innerHTML = `<option value="">Select end time</option>`;

        let found = false;

        Array.from(startTime.options).forEach(opt => {

            if (opt.value && opt.value >= start) {
                found = true;
                endTime.innerHTML += `<option value="${opt.value}">${opt.value}</option>`;
            }
        });

        endTime.disabled = !found;
    });

});
</script>
@endsection