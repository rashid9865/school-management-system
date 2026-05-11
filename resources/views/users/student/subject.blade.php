@extends('users.student.layout')

@section('title')
Student Subjects
@endsection

@section('css')
<link href="{{ asset('css/student/subject.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="student-subject-container">
    <section class="student-subject-header">
        <div>
            <h1>Enrolled Subjects</h1>
            <p class="student-subject-intro">Review all assigned subjects and the teaching staff for each course.</p>
        </div>
    </section>

    <section class="student-subject-card">
        <div class="student-subject-table-wrap">
            <table class="student-subject-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Teacher</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($subjects as $subject)
                        <tr>
                            <td>{{ $subject->name ?? $subject->course_name ?? 'N/A' }}</td>
                            <td>
                                @php $teacher = $subject->teachers->first(); @endphp
                                @if($teacher && $teacher->user)
                                    {{ $teacher->user->name }}
                                @else
                                    <span style="color: #9ca3af;">Not assigned</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No subjects assigned yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection