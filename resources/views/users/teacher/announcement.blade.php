@extends('users.teacher.layout')
@section('title')
Announcements
@endsection
@section('css')
<link href="{{ asset('css/teacher/announcement.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="announce-container">
    <h2>Announcements</h2>
    <div class="announcement-form">
        <form action="#" method="post">
            @csrf
            <textarea name="message" placeholder="Create announcement" required></textarea>
            <button type="submit">Post Announcement</button>
        </form>
    </div>
    <div class="announcements-list">
        <p>No announcements yet.</p>
        <!-- Placeholder for displaying announcements -->
    </div>
</div>
@endsection