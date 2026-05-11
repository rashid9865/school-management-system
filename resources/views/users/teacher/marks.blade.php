@extends('users.teacher.layout')

@section('title')
Marks
@endsection

@section('css')
<link href="{{ asset('css/teacher/marks.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="marks-container">
    <h2>Student Marks</h2>
    <div class="marks-actions">
        <button class="btn-add" onclick="toggleForm()">Add Marks</button>
    </div>
    <div id="add-marks-form" style="display: none;">
        <form action="#" method="post">
            @csrf
            <input type="text" name="semester" placeholder="Enter semester no" required>
            <input type="text" name="course" placeholder="Enter course name" required>
            <input type="text" name="title" placeholder="Enter title" required>
            <input type="number" step="0.01" name="grade_point" placeholder="Enter grade points" required>
            <input type="text" name="grade" placeholder="Enter grades" required>
            <input type="number" step="0.01" name="percentage" placeholder="Enter equivalent percentage" required>
            <input type="number" step="0.01" name="percentile" placeholder="Enter percentile" required>
            <button type="submit">Add Marks</button>
        </form>
    </div>
    @if($marks->count() > 0)
        <table class="marks-table">
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Subject</th>
                    <th>Semester</th>
                    <th>Title</th>
                    <th>Grade Point</th>
                    <th>Grade</th>
                    <th>Percentage</th>
                    <th>Percentile</th>
                </tr>
            </thead>
            <tbody>
                @foreach($marks as $mark)
                    <tr>
                        <td>{{ $mark->student->name }}</td>
                        <td>{{ $mark->subjects->name ?? 'N/A' }}</td>
                        <td>{{ $mark->semester ?? 'N/A' }}</td>
                        <td>{{ $mark->title ?? 'N/A' }}</td>
                        <td>{{ $mark->grade_point ?? 'N/A' }}</td>
                        <td>{{ $mark->grade ?? 'N/A' }}</td>
                        <td>{{ $mark->percentage ?? 'N/A' }}</td>
                        <td>{{ $mark->percentile ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No marks entered yet.</p>
    @endif
</div>
<script>
function toggleForm() {
    var form = document.getElementById('add-marks-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection