@extends('users.student.layout')

@section('title')
Student Timetable
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
    --warning: #f59e0b;
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
    max-width: 1400px;
    background: var(--surface);
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 35px 90px rgba(15, 23, 42, 0.16);
    border: 1px solid rgba(59, 130, 246, 0.18);
}

.timetable-header {
    padding: 36px 42px 28px;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    display: flex;
    justify-content: space-between;
    gap: 24px;
    align-items: flex-start;
}

.timetable-title {
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

.timetable-header h1 {
    margin: 0;
    font-size: clamp(2rem, 2.5vw, 2.8rem);
    line-height: 1.05;
}

.timetable-header p {
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

.timetable-body {
    padding: 36px 42px 42px;
    background: var(--surface-soft);
}

.timetable-grid-container {
    background: var(--surface);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
    overflow-x: auto;
}

.timetable-grid {
    width: 100%;
    border-collapse: collapse;
    min-width: 900px;
}

.timetable-grid th {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    padding: 1rem 0.75rem;
    text-align: center;
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.timetable-grid th:first-child {
    text-align: left;
    border-radius: 12px 0 0 0;
    min-width: 100px;
}

.timetable-grid th:last-child {
    border-radius: 0 12px 0 0;
}

.timetable-grid td {
    padding: 0.75rem;
    text-align: center;
    border: 1px solid var(--border);
    vertical-align: middle;
    min-width: 100px;
    height: 80px;
    position: relative;
}

.timetable-grid td:first-child {
    text-align: left;
    font-weight: 700;
    background: var(--surface-soft);
    color: var(--primary);
    border-radius: 8px 0 0 8px;
}

.timetable-grid td.period-time {
    background: #f8fafc;
    font-weight: 600;
    color: var(--muted);
    font-size: 0.85rem;
    border-radius: 0;
}

.subject-block {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    padding: 0.5rem;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    text-align: center;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    cursor: pointer;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 0.25rem;
}

.subject-block:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
}

.subject-block.math {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.subject-block.science {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.subject-block.english {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    box-shadow: 0 4px 12px rgba(139, 92, 246, 0.3);
}

.subject-block.history {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.subject-block.computer {
    background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
    box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
}

.subject-block.pe {
    background: linear-gradient(135deg, #84cc16 0%, #65a30d 100%);
    box-shadow: 0 4px 12px rgba(132, 204, 22, 0.3);
}

.subject-name {
    font-weight: 700;
    font-size: 0.9rem;
}

.subject-teacher {
    font-size: 0.75rem;
    opacity: 0.9;
}

.subject-room {
    font-size: 0.7rem;
    opacity: 0.8;
    background: rgba(255, 255, 255, 0.2);
    padding: 0.125rem 0.375rem;
    border-radius: 6px;
    margin-top: 0.25rem;
}

.empty-cell {
    background: var(--surface-soft);
    border-radius: 8px;
}

.no-timetable {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--muted);
    background: var(--surface);
    border-radius: 24px;
    box-shadow: 0 10px 30px rgba(15, 23, 42, 0.08);
}

.no-timetable i {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    opacity: 0.3;
}

.no-timetable h3 {
    margin: 0 0 1rem;
    color: var(--text);
}

.no-timetable p {
    margin: 0;
    line-height: 1.6;
}

@media (max-width: 720px) {
    .timetable-card {
        margin: 0 18px;
    }

    .timetable-header,
    .timetable-body {
        padding-left: 24px;
        padding-right: 24px;
    }

    .timetable-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .timetable-grid-container {
        padding: 1rem;
    }

    .timetable-grid th,
    .timetable-grid td {
        padding: 0.5rem;
        font-size: 0.8rem;
        min-width: 80px;
        height: 60px;
    }

    .subject-block {
        font-size: 0.75rem;
    }
}

@media (max-width: 520px) {
    .timetable-header h1 {
        font-size: 2rem;
    }

    .timetable-grid th,
    .timetable-grid td {
        padding: 0.375rem;
        font-size: 0.7rem;
        min-width: 70px;
        height: 50px;
    }

    .subject-name {
        font-size: 0.8rem;
    }

    .subject-teacher {
        font-size: 0.65rem;
    }

    .subject-room {
        font-size: 0.6rem;
    }
}
</style>
@endsection

@section('content')
<div class="timetable-page">
    <div class="timetable-card">
        <div class="timetable-header">
            <div class="timetable-title">
                <span class="eyebrow">Academic schedule</span>
                <h1>Class Timetable</h1>
                <p>Your weekly schedule at a glance with all subjects and time slots</p>
            </div>
            <span class="timetable-badge">{{ $timetables->count() }} classes</span>
        </div>
        <div class="timetable-body">
            @if($timetables->isEmpty())
                <div class="no-timetable">
                    <i class="fas fa-calendar-alt"></i>
                    <h3>No Timetable Available</h3>
                    <p>Your class timetable hasn't been set up yet. Please check back later or contact your administrator.</p>
                </div>
            @else
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
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Organize timetables by day and time
                                $schedule = [];
                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $timeSlots = [
                                    '08:00-09:00', '09:00-10:00', '10:00-11:00', '11:00-12:00',
                                    '12:00-13:00', '13:00-14:00', '14:00-15:00', '15:00-16:00'
                                ];
                                
                                foreach($timetables as $item) {
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection