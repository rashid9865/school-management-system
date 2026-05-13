@extends('users.admin.layout')

@section('title')
Create Timetable
@endsection

@section('css')
<style>
:root {
    color-scheme: light;
    --bg: #eaf5ff;
    --surface: #ffffff;
    --surface-soft: #f8fbff;
    --border: #cfe0ff;
    --text: #0f172a;
    --muted: #475569;
    --primary: #2563eb;
    --primary-dark: #1d4ed8;
    --success: #16a34a;
    --danger: #dc2626;
}

.timetable-page {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 50px 0 70px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    min-height: calc(100vh - 130px);
    background: linear-gradient(180deg, #eaf5ff 0%, #f9fbff 55%, #ffffff 100%);
    color: var(--text);
}

.timetable-card {
    width: 100%;
    max-width: 680px;
    background: var(--surface);
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 35px 90px rgba(15, 23, 42, 0.16);
    border: 1px solid rgba(59, 130, 246, 0.18);
}

.timetable-card-header {
    padding: 36px 42px 28px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    display: flex;
    justify-content: space-between;
    gap: 24px;
    align-items: flex-start;
}

.timetable-card-title {
    max-width: 72%;
}

.eyebrow {
    display: inline-block;
    margin-bottom: 16px;
    font-size: 0.85rem;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    opacity: 0.9;
}

.timetable-card-header h1 {
    margin: 0;
    font-size: clamp(2rem, 2.5vw, 2.8rem);
    line-height: 1.05;
}

.timetable-card-header p {
    margin: 18px 0 0;
    color: rgba(255, 255, 255, 0.88);
    line-height: 1.7;
}

.timetable-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 10px 18px;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.18);
    color: #ffffff;
    font-weight: 700;
    font-size: 0.92rem;
    white-space: nowrap;
}

.timetable-card-body {
    padding: 36px 42px 42px;
    background: var(--surface-soft);
}

.alert {
    padding: 16px 18px;
    border-radius: 18px;
    margin-bottom: 24px;
    font-size: 0.95rem;
}

.alert-success {
    background: #ecfdf5;
    color: var(--success);
    border: 1px solid #bbf7d0;
}

.alert-error {
    background: #fee2e2;
    color: var(--danger);
    border: 1px solid #fecaca;
}

.form-grid {
    display: grid;
    gap: 22px;
}

.form-group {
    display: grid;
    gap: 10px;
}

.form-group label {
    color: var(--text);
    font-weight: 700;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 15px 18px;
    border-radius: 18px;
    border: 1px solid var(--border);
    background: #ffffff;
    color: var(--text);
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-group input:focus,
.form-group select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.16);
}

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.btn-submit {
    padding: 16px 32px;
    border: none;
    border-radius: 20px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 40px rgba(59, 130, 246, 0.18);
}

.btn-cancel {
    padding: 16px 32px;
    border: 2px solid var(--border);
    border-radius: 20px;
    background: transparent;
    color: var(--muted);
    font-size: 1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    text-align: center;
}

.btn-cancel:hover {
    border-color: var(--primary);
    color: var(--primary);
    background: rgba(59, 130, 246, 0.05);
}

.quick-add-section {
    background: var(--surface);
    border-radius: 24px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
}

.quick-add-section h3 {
    margin: 0 0 1.5rem 0;
    color: var(--text);
    font-size: 1.25rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quick-add-section h3 i {
    color: var(--primary);
}

.timetable-preview-section {
    background: var(--surface);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
}

.timetable-preview-section h3 {
    margin: 0 0 1.5rem 0;
    color: var(--text);
    font-size: 1.25rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.timetable-preview-section h3 i {
    color: var(--primary);
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    border-radius: 6px;
}

.btn-danger {
    background: var(--danger);
    color: white;
    border: none;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-danger:hover {
    background: #b91c1c;
    transform: translateY(-1px);
}

@media (max-width: 720px) {
    .timetable-card {
        margin: 0 18px;
    }

    .timetable-card-header,
    .timetable-card-body {
        padding-left: 24px;
        padding-right: 24px;
    }

    .timetable-card-header {
        flex-direction: column;
        align-items: flex-start;
    }
}

@media (max-width: 520px) {
    .timetable-card-header h1 {
        font-size: 2rem;
    }
}
</style>
@endsection

@section('content')
<div class="timetable-page">
    <div class="timetable-card">
        <div class="timetable-card-header">
            <div class="timetable-card-title">
                <span class="eyebrow">Schedule management</span>
                <h1>Create Timetable</h1>
                <p>Add new timetable entries for teachers and subjects</p>
            </div>
            <span class="timetable-badge">New entry</span>
        </div>
        <div class="timetable-card-body">
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Quick Add Section -->
            <div class="quick-add-section">
                <h3><i class="fas fa-plus-circle"></i> Quick Add Entry</h3>
                <form action="{{ route('timetable.store') }}" method="POST" id="timetableForm">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="teacher_id">Teacher</label>
                            <select name="teacher_id" id="teacher_id" required>
                                <option value="">Select a teacher</option>
                                @if(isset($teachers))
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                            {{ $teacher->user->name ?? $teacher->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="subject_id">Subject</label>
                            <select name="subject_id" id="subject_id" required disabled>
                                <option value="">Select a teacher first</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="day">Day</label>
                            <select name="day" id="day" required>
                                <option value="">Select a day</option>
                                <option value="Monday" {{ old('day') == 'Monday' ? 'selected' : '' }}>Monday</option>
                                <option value="Tuesday" {{ old('day') == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                <option value="Wednesday" {{ old('day') == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                <option value="Thursday" {{ old('day') == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                <option value="Friday" {{ old('day') == 'Friday' ? 'selected' : '' }}>Friday</option>
                                <option value="Saturday" {{ old('day') == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                <option value="Sunday" {{ old('day') == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start_time">Start Time</label>
                            <input type="time" id="start_time" name="start_time" value="{{ old('start_time') ?: '08:00' }}" min="07:00" max="22:00" required>
                        </div>

                        <div class="form-group">
                            <label for="end_time">End Time</label>
                            <input type="time" id="end_time" name="end_time" value="{{ old('end_time') ?: '09:00' }}" min="07:00" max="23:00" required>
                        </div>

                        <div class="form-group">
                            <label for="classroom">Classroom</label>
                            <input type="text" id="classroom" name="classroom" placeholder="Enter classroom number" value="{{ old('classroom') }}">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit"><i class="fas fa-plus"></i> Add Entry</button>
                        <a href="{{ route('timetable.index') }}" class="btn-cancel"><i class="fas fa-times"></i> Cancel</a>
                    </div>
                </form>
            </div>

            <!-- Current Timetable Preview -->
            @if(isset($currentTimetables) && $currentTimetables->isNotEmpty())
            <div class="timetable-preview-section">
                <h3><i class="fas fa-calendar-alt"></i> Current Timetable Preview</h3>
                <div class="timetable-grid-container">
                    <table class="timetable-grid">
                        <thead>
                            <tr>
                                <th>Day / Time</th>
                                <th>08:00 - 09:00</th>
                                <th>09:00 - 10:00</th>
                                <th>10:00 - 11:00</th>
                                <th>11:00 - 12:00</th>
                                <th>12:00 - 01:00</th>
                                <th>01:00 - 02:00</th>
                                <th>02:00 - 03:00</th>
                                <th>03:00 - 04:00</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Organize current timetables by day and time
                                $schedule = [];
                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $timeSlots = [
                                    '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00',
                                    '12:00-13:00', '13:00-14:00', '14:00-15:00', '15:00-16:00'
                                ];
                                
                                foreach($currentTimetables as $item) {
                                    $day = ucfirst($item->day);
                                    $timeKey = $item->start_time . '-' . $item->end_time;
                                    if (!isset($schedule[$day])) {
                                        $schedule[$day] = [];
                                    }
                                    $schedule[$day][$timeKey] = $item;
                                }
                            @endphp
                            
                            @foreach($days as $day)
                                <tr>
                                    <td>{{ $day }}</td>
                                    @foreach($timeSlots as $timeSlot)
                                        <td>
                                            @if(isset($schedule[$day][$timeSlot]))
                                                @php
                                                    $item = $schedule[$day][$timeSlot];
                                                    $subjectClass = 'subject-block';
                                                    if(stripos($item->subject, 'math') !== false) $subjectClass .= ' math';
                                                    elseif(stripos($item->subject, 'science') !== false || stripos($item->subject, 'physics') !== false || stripos($item->subject, 'chemistry') !== false || stripos($item->subject, 'biology') !== false) $subjectClass .= ' science';
                                                    elseif(stripos($item->subject, 'english') !== false) $subjectClass .= ' english';
                                                    elseif(stripos($item->subject, 'history') !== false || stripos($item->subject, 'geography') !== false) $subjectClass .= ' history';
                                                    elseif(stripos($item->subject, 'computer') !== false) $subjectClass .= ' computer';
                                                    elseif(stripos($item->subject, 'physical') !== false || stripos($item->subject, 'pe') !== false) $subjectClass .= ' pe';
                                                @endphp
                                                <div class="{{ $subjectClass }}">
                                                    <div class="subject-name">{{ $item->subject }}</div>
                                                    @if(isset($item->teacher_name))
                                                        <div class="subject-teacher">{{ $item->teacher_name }}</div>
                                                    @endif
                                                    @if(isset($item->classroom))
                                                        <div class="subject-room">Room {{ $item->classroom }}</div>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="empty-cell"></div>
                                            @endif
                                        </td>
                                    @endforeach
                                    <td>
                                        <div class="action-buttons">
                                            @if(isset($schedule[$day]))
                                                @foreach($schedule[$day] as $timeKey => $item)
                                                    <form action="{{ route('timetable.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this entry?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const teacherSelect = document.getElementById('teacher_id');
    const subjectSelect = document.getElementById('subject_id');
    const startTimeInput = document.getElementById('start_time');
    const endTimeInput = document.getElementById('end_time');
    const form = document.getElementById('timetableForm');

    // Common subjects available for all teachers
    const commonSubjects = [
        {id: 'mathematics', name: 'Mathematics'},
        {id: 'physics', name: 'Physics'},
        {id: 'chemistry', name: 'Chemistry'},
        {id: 'biology', name: 'Biology'},
        {id: 'english', name: 'English'},
        {id: 'history', name: 'History'},
        {id: 'geography', name: 'Geography'},
        {id: 'computer_science', name: 'Computer Science'},
        {id: 'physical_education', name: 'Physical Education'},
        {id: 'art', name: 'Art'},
        {id: 'music', name: 'Music'},
        {id: 'economics', name: 'Economics'},
        {id: 'business_studies', name: 'Business Studies'}
    ];

    // Handle teacher selection change
    teacherSelect.addEventListener('change', function() {
        const teacherId = this.value;
        
        // Clear subject dropdown
        subjectSelect.innerHTML = '';
        subjectSelect.disabled = false;

        // Add default option
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = 'Select a subject';
        subjectSelect.appendChild(defaultOption);

        if (teacherId) {
            // Add all common subjects for any teacher
            commonSubjects.forEach(subject => {
                const option = document.createElement('option');
                option.value = subject.id;
                option.textContent = subject.name;
                subjectSelect.appendChild(option);
            });
        } else {
            subjectSelect.innerHTML = '<option value="">Select a teacher first</option>';
            subjectSelect.disabled = true;
        }
    });

    // Handle time validation
    startTimeInput.addEventListener('change', function() {
        const startTime = this.value;
        if (startTime) {
            // Set minimum end time to 30 minutes after start time
            const [hours, minutes] = startTime.split(':');
            let endHours = parseInt(hours);
            let endMinutes = parseInt(minutes) + 30;
            
            if (endMinutes >= 60) {
                endHours += 1;
                endMinutes -= 60;
            }
            
            const minEndTime = `${endHours.toString().padStart(2, '0')}:${endMinutes.toString().padStart(2, '0')}`;
            endTimeInput.min = minEndTime;
            
            // If current end time is before new minimum, update it
            if (endTimeInput.value && endTimeInput.value < minEndTime) {
                endTimeInput.value = minEndTime;
            }
        }
    });

    // Form validation before submission
    form.addEventListener('submit', function(e) {
        const startTime = startTimeInput.value;
        const endTime = endTimeInput.value;
        const day = document.getElementById('day').value;
        const subject = subjectSelect.value;
        const teacher = teacherSelect.value;
        
        // Check if all required fields are filled
        if (!teacher) {
            e.preventDefault();
            alert('Please select a teacher');
            teacherSelect.focus();
            return;
        }
        
        if (!subject) {
            e.preventDefault();
            alert('Please select a subject');
            subjectSelect.focus();
            return;
        }
        
        if (!day) {
            e.preventDefault();
            alert('Please select a day');
            document.getElementById('day').focus();
            return;
        }
        
        if (!startTime) {
            e.preventDefault();
            alert('Please select start time');
            startTimeInput.focus();
            return;
        }
        
        if (!endTime) {
            e.preventDefault();
            alert('Please select end time');
            endTimeInput.focus();
            return;
        }
        
        if (endTime <= startTime) {
            e.preventDefault();
            alert('End time must be after start time');
            endTimeInput.focus();
            return;
        }
        
        // Check if duration is at least 30 minutes
        const start = new Date(`2000-01-01T${startTime}`);
        const end = new Date(`2000-01-01T${endTime}`);
        const duration = (end - start) / (1000 * 60); // duration in minutes
        
        if (duration < 30) {
            e.preventDefault();
            alert('Class duration must be at least 30 minutes');
            endTimeInput.focus();
            return;
        }
        
        // Check if duration is more than 4 hours
        if (duration > 240) {
            e.preventDefault();
            alert('Class duration cannot be more than 4 hours');
            endTimeInput.focus();
            return;
        }
    });

    // Load initial data if teacher is pre-selected
    if (teacherSelect.value) {
        teacherSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endsection
