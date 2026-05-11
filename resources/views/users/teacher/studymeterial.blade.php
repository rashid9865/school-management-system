@extends('users.teacher.layout')
@section('title')
Study Materials
@endsection
@section('css')
<link href="{{ asset('css/teacher/studymeterial.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="studymeterial-container">
    <h2>Study Materials</h2>
    <div class="material-actions">
        <button class="btn-upload" onclick="toggleForm()">Upload New Material</button>
    </div>
    <div id="upload-form" style="display: none;">
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" name="subject" placeholder="Enter subject name" required>
            <input type="file" name="video" accept="video/*">
            <input type="file" name="handouts" accept=".pdf,.doc,.docx">
            <input type="file" name="powerpoints" accept=".ppt,.pptx">
            <select name="day">
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>
                <option>Sunday</option>
            </select>
            <button type="submit">Upload</button>
        </form>
    </div>
    <div class="materials-list">
        <p>No materials uploaded yet.</p>
        <!-- Placeholder for displaying materials -->
    </div>
</div>
<script>
function toggleForm() {
    var form = document.getElementById('upload-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
@endsection