@extends('users.teacher.layout')

@section('title')
Assignments
@endsection

@section('css')
<link href="{{ asset('css/teacher/assignment.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="assignment-container">
    <h2>My Assignments</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <section class="assignment-form-card" id="create-assignment">
        <h3>Create New Assignment</h3>
        <form action="{{ route('teacher.assignments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="subject_id">Subject</label>
                <select id="subject_id" name="subject_id" required>
                    <option value="">Choose subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                @error('subject_id') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group-inline">
                <div>
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required />
                    @error('start_date') <span class="error">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="due_date">Due Date</label>
                    <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}" required />
                    @error('due_date') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="assignment_file">Assignment File</label>
                <input type="file" id="assignment_file" name="assignment_file" accept=".pdf,.doc,.docx,.jpg,.png" />
                @error('assignment_file') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label for="action">Notes / Instructions</label>
                <textarea id="action" name="action" rows="4" placeholder="Add instructions for the students">{{ old('action') }}</textarea>
                @error('action') <span class="error">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn-submit">Create Assignment</button>
        </form>
    </section>

    @if($assignments->count() > 0)
        <table class="assignments-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Start Date</th>
                    <th>Due Date</th>
                    <th>Assignment File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assignments as $assignment)
                    <tr>
                        <td>{{ $assignment->course_name ?? 'N/A' }}</td>
                        <td>{{ $assignment->start_date ? \Carbon\Carbon::parse($assignment->start_date)->format('d M Y') : 'N/A' }}</td>
                        <td>{{ $assignment->due_date ? \Carbon\Carbon::parse($assignment->due_date)->format('d M Y') : 'N/A' }}</td>
                        <td>
                            @if($assignment->assignment_file)
                                <a href="{{ asset('storage/' . $assignment->assignment_file) }}" target="_blank">Download</a>
                            @else
                                No file
                            @endif
                        </td>
                        <td>
                            <span class="btn-disabled">Edit</span>
                            <span class="btn-disabled">Delete</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No assignments created yet.</p>
    @endif
</div>
@endsection