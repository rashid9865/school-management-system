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

    .error-text {
        color: #dc3545;
        font-size: 0.875rem;
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

    const gradeSelect = document.getElementById('grade');
    const scheduleSelect = document.getElementById('schedule');
    const daySelect = document.getElementById('day');
    const subjectSelect = document.getElementById('subject');
    const startTimeSelect = document.getElementById('start_time');
    const endTimeSelect = document.getElementById('end_time');

   

    // =========================
    // GRADE CHANGE
    // =========================
    gradeSelect.addEventListener('change', function () {

        const gradeId = this.value;
        // reset fields
        subjectSelect.innerHTML =
            '<option value="">Select Subject</option>';

        startTimeSelect.innerHTML =
            '<option value="">Select Subject First</option>';

        endTimeSelect.innerHTML =
            '<option value="">Select Start Time First</option>';

        subjectSelect.disabled = true;
        startTimeSelect.disabled = true;
        endTimeSelect.disabled = true;

        if (!gradeId) {
            return;
        }

        // load all subjects of this grade
        loadSubjects();
       
    });

    // =========================
    // SCHEDULE CHANGE
    // =========================
    scheduleSelect.addEventListener('change', function () {

        const option =
            this.options[this.selectedIndex];
        const selectedDay =
            option.getAttribute('data-day');

        console.log('Selected Day:', selectedDay);

        if (!selectedDay) {
            daySelect.innerHTML =
                '<option value="">Select Day</option>';
            return;
        }

        // set day automatically
        daySelect.innerHTML =
            `<option value="${selectedDay}">
                ${selectedDay}
            </option>`;

        // IMPORTANT:
        // do NOT hide subjects here
        // only reload subjects normally

        if (gradeSelect.value) {
            loadSubjects();
        }
    });

    // =========================
    // LOAD SUBJECTS
    // =========================
    function loadSubjects() {

        const gradeId = gradeSelect.value;
        if (!gradeId) {
            return;
        }

        subjectSelect.disabled = true;

        subjectSelect.innerHTML =
            '<option>Loading...</option>';
       
        fetch(`/available-subjects?grade_id=${gradeId}`)
            .then(response => response.json())
            .then(data => {

                console.log('Subjects:', data);

                subjectSelect.innerHTML =
                    '<option value="">Select Subject</option>';

                if (!data.length) {

                    subjectSelect.innerHTML +=
                        '<option disabled>No subjects available</option>';

                    subjectSelect.disabled = true;

                    return;
                }

                data.forEach(subject => {

                    const subName =
                        subject.name ?? subject;

                    subjectSelect.innerHTML += `
                        <option value="${subName}">
                            ${subName}
                        </option>
                    `;
                });

                subjectSelect.disabled = false;
            })
            .catch(error => {

                console.log(error.message);

                subjectSelect.innerHTML =
                    '<option>Error loading subjects</option>';

                subjectSelect.disabled = true;
            });
    }

    // =========================
    // SUBJECT CHANGE
    // =========================
    subjectSelect.addEventListener('change', function () {

        const subject = this.value;

        startTimeSelect.innerHTML =
            '<option value="">Select Start Time</option>';

        endTimeSelect.innerHTML =
            '<option value="">Select Start Time First</option>';

        startTimeSelect.disabled = true;
        endTimeSelect.disabled = true;

        if (!subject) {
            return;
        }

        const gradeId =
            gradeSelect.value;

        const scheduleId =
            scheduleSelect.value;

        const day =
            daySelect.value;

        if (!gradeId || !scheduleId || !day) {
            return;
        }

        fetch(
            `/api/available-times?grade_id=${gradeId}&subject=${encodeURIComponent(subject)}&day=${encodeURIComponent(day)}&schedule_id=${scheduleId}`
        )
        .then(response => response.json())
        .then(data => {

            console.log('Times:', data);

            startTimeSelect.innerHTML =
                '<option value="">Select Start Time</option>';

            if (!data.length) {

                startTimeSelect.innerHTML +=
                    '<option disabled>No Times Available</option>';

                startTimeSelect.disabled = true;

                return;
            }

            data.forEach(time => {

                startTimeSelect.innerHTML += `
                    <option value="${time}">
                        ${time}
                    </option>
                `;
            });

            startTimeSelect.disabled = false;
        })
        .catch(error => {

            console.log(error);

            startTimeSelect.innerHTML =
                '<option>Error loading times</option>';
        });
    });

    // =========================
    // START TIME CHANGE
    // =========================
    startTimeSelect.addEventListener('change', function () {

        const selectedStartTime =
            this.value;

        endTimeSelect.innerHTML =
            '<option value="">Select End Time</option>';

        if (!selectedStartTime) {

            endTimeSelect.disabled = true;

            return;
        }

        let found = false;

        Array.from(startTimeSelect.options)
            .forEach(option => {

                if (
                    option.value &&
                    option.value > selectedStartTime
                ) {

                    found = true;

                    endTimeSelect.innerHTML += `
                        <option value="${option.value}">
                            ${option.value}
                        </option>
                    `;
                }
            });

        if (!found) {

            endTimeSelect.innerHTML +=
                '<option disabled>No End Time Available</option>';

            endTimeSelect.disabled = true;

            return;
        }

        endTimeSelect.disabled = false;
    });

});
</script>
@endsection