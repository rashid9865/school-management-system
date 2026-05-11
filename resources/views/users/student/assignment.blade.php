@extends('users.student.layout')

@section('title')
Assignments
@endsection

@section('css')
<link href="{{ asset('css/student/assignment.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="assignment-container">
    <header class="assignment-header">
        <div>
            <h1>Your assignments</h1>
            <p class="assignment-subtitle">View all assigned coursework, submission deadlines, and teacher details in one place.</p>
        </div>
    </header>

    <section class="assignment-card">
        <div class="assignment-table-wrap">
            <table class="assignment-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Start date</th>
                        <th>Due date</th>
                        <th>File</th>
                        <th>Teacher</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->course_name ?? $assignment->name ?? 'N/A' }}</td>
                            <td>{{ optional($assignment->start_date)->format('d M Y') ?? $assignment->start_date ?? 'N/A' }}</td>
                            <td>{{ optional($assignment->due_date)->format('d M Y') ?? $assignment->due_date ?? 'N/A' }}</td>
                            <td>
                                @if(!empty($assignment->assignment_file))
                                    <a href="{{ asset('storage/' . $assignment->assignment_file) }}" target="_blank" class="assignment-file-link">Download</a>
                                @else
                                    <span class="assignment-file-empty">No file</span>
                                @endif
                            </td>
                            <td>{{ $assignment->teacher->name ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="assignment-empty">No assignments available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection