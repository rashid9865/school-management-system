@extends('users.teacher.layout')
@section('title')
My Students
@endsection
@section('css')
<link href="{{ asset('css/teacher/tseestudent.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="teachersees-container">
    <h2>My Students</h2>
    @if($students->count() > 0)
        <table class="students-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>Address</th>
                    <th>Date of Birth</th>
                    <th>Phone No</th>
                    <th>Department</th>
                    <th>Enroll Date</th>
                    <th>Age</th>
                    <th>Roll No</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->user->name ?? $student->name ?? 'N/A' }}</td>
                        <td>{{ $student->father_name ?? 'N/A' }}</td>
                        <td>{{ $student->address ?? 'N/A' }}</td>
                        <td>{{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d M Y') : 'N/A' }}</td>
                        <td>{{ $student->phone ?? 'N/A' }}</td>
                        <td>{{ $student->grade->name ?? 'N/A' }}</td>
                        <td>{{ $student->created_at ? \Carbon\Carbon::parse($student->created_at)->format('d M Y') : 'N/A' }}</td>
                        <td>{{ $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->age : 'N/A' }}</td>
                        <td>{{ $student->roll_no ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('student.show', $student->id) }}" class="btn-view">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No students assigned yet.</p>
    @endif
</div>
@endsection