@extends('users.student.layout')

@section('title')
Student Timetable
@endsection

@section('css')
<link href="{{ asset('css/student/timeTable.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="timeTable-container">
    <header class="timetable-header">
        <div>
            <h1>Class Timetable</h1>
            <p class="timetable-subtitle">Your weekly schedule at a glance, with class names and session timings.</p>
        </div>
    </header>

    <section class="timetable-card">
        <div class="timetable-table-wrap">
            <table class="timetable-table">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Subject</th>
                        <th>Start</th>
                        <th>End</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($timetables as $item)
                        <tr>
                            <td>{{ ucfirst($item->day) }}</td>
                            <td>{{ $item->subject }}</td>
                            <td>{{ $item->start_time }}</td>
                            <td>{{ $item->end_time }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="timetable-empty">No timetable entries found for your class.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection