@extends('users.admin.layout')

@section('title')
Create Student Timetable
@endsection

@section('css')
<style>
.timetable-card {
    max-width: 700px;
    margin: 40px auto;
    padding: 28px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    box-shadow: 0 18px 60px rgba(15, 23, 42, 0.09);
}

.timetable-header h2 {
    margin: 0;
    font-size: 1.6rem;
}

.form-group {
    margin-bottom: 16px;
    display: grid;
    gap: 6px;
}

.form-label {
    font-weight: 600;
}

.form-select {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #cbd5e1;
    background: #f8fbff;
}

.form-select:disabled {
    background: #e5e7eb;
    cursor: not-allowed;
}

.btn-primary {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 12px;
    background: #0ea5e9;
    color: white;
    font-weight: 600;
    cursor: pointer;
}
</style>
@endsection


@section('content')
<div class="timetable-card">

    <div class="timetable-header">
        <h2>Create Student Timetable</h2>
    </div>

    <form action="{{ route('timetable') }}" method="POST">
        @csrf

        {{-- Grade --}}
        <div class="form-group">
            <label class="form-label">Grade</label>
            <select name="grade_id" id="grade" class="form-select">
                <option value="">Select Grade</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Schedule --}}
        <div class="form-group">
            <label class="form-label">Schedule</label>
            <select name="schedule_id" id="schedule" class="form-select">
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
            <label class="form-label">Day</label>
            <select name="day" id="day" class="form-select">
                <option value="">Select Day</option>
            </select>
        </div>

        {{-- Subject --}}
        <div class="form-group">
            <label class="form-label">Subject</label>
            <select name="subject" id="subject" class="form-select" disabled>
                <option>Select schedule first</option>
            </select>
        </div>

        {{-- Start Time --}}
        <div class="form-group">
            <label class="form-label">Start Time</label>
            <select name="start_time" id="start_time" class="form-select" disabled>
                <option>Select subject first</option>
            </select>
        </div>

        {{-- End Time --}}
        <div class="form-group">
            <label class="form-label">End Time</label>
            <select name="end_time" id="end_time" class="form-select" disabled>
                <option>Select start time first</option>
            </select>
        </div>

        <button type="submit" class="btn-primary">Save Timetable</button>
    </form>
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