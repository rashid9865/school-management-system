@extends('users.admin.layout')

@section('title')
    Timetables
@endsection

@section('content')
    <div class="container">
        <h1>Timetables</h1>
        <a href="{{ route('createStudentTimetable') }}" class="btn btn-primary">Create New Timetable</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Grade</th>
                    <th>Subject</th>
                    <th>Day</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($timetables as $timetable)
                    <tr>
                        <td>{{ $timetable->id }}</td>
                        <td>{{ $grades->firstWhere('id', $timetable->grade_id)->name ?? 'N/A' }}</td>
                        <td>{{ $timetable->subject }}</td>
                        <td>{{ $timetable->day }}</td>
                        <td>{{ $timetable->start_time }}</td>
                        <td>{{ $timetable->end_time }}</td>
                        <td>
                            <a href="{{ route('editStudentTimetable', $timetable->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.timetables.destroy', $timetable->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection