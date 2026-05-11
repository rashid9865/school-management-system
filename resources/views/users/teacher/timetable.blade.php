@extends('users.teacher.layout')
@section('title')
Timetable
@endsection
@section('css')
<link href="{{ asset('css/teacher/timetable.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="timetable-container">
    <h2>My Timetable</h2>
    @if($timetables->count() > 0)
        <table class="timetable-table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
            </thead>
            <tbody>
                @foreach($timetables->groupBy('time') as $time => $slots)
                    <tr>
                        <td>{{ $time }}</td>
                        @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                            <td>
                                @php
                                    $slot = $slots->where('day', $day)->first();
                                @endphp
                                {{ $slot ? $slot->month : '-' }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No timetable assigned yet.</p>
    @endif
</div>
@endsection