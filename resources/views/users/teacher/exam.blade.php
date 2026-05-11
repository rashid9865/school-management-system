@extends('users.teacher.layout')
@section('title')
Exams
@endsection
@section('css')
<link href="{{ asset('css/teacher/exam.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="exam-container">
    <h2>Exams</h2>
    <div class="exam-actions">
        <button class="btn-create" onclick="toggleForm()">Create New Exam</button>
    </div>
    <div id="create-exam-form" style="display: none;">
        <form action="#" method="post">
            @csrf
            <input type="text" name="subject" placeholder="Enter subject name" required>
            <input type="date" name="start_date" placeholder="Enter start date" required>
            <input type="date" name="end_date" placeholder="Enter end date" required>
            <input type="time" name="start_time" placeholder="Enter start time" required>
            <input type="time" name="end_time" placeholder="Enter end time" required>
            <input type="number" name="seats" placeholder="Available seats" required>
            <select name="day">
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
            </select>
            <button type="submit">Create Exam</button>
        </form>
    </div>
    @if($exams->count() > 0)
        <table class="exams-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Seats</th>
                    <th>Day</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($exams as $exam)
                    <tr>
                        <td>{{ $exam->subject ?? 'N/A' }}</td>
                        <td>{{ $exam->start_date ? \Carbon\Carbon::parse($exam->start_date)->format('d M Y') : 'N/A' }}</td>
                        <td>{{ $exam->end_date ? \Carbon\Carbon::parse($exam->end_date)->format('d M Y') : 'N/A' }}</td>
                        <td>{{ $exam->start_time ?? 'N/A' }}</td>
                        <td>{{ $exam->end_time ?? 'N/A' }}</td>
                        <td>{{ $exam->seats ?? 'N/A' }}</td>
                        <td>{{ $exam->day ?? 'N/A' }}</td>
                        <td>
                            <a href="#" class="btn-edit">Edit</a>
                            <a href="#" class="btn-delete">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No exams scheduled yet.</p>
    @endif
</div>
<script>
function toggleForm() {
    var form = document.getElementById('create-exam-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection