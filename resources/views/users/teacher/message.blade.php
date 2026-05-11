@extends('users.teacher.layout')

@section('title')
Messages
@endsection

@section('css')
<link href="{{ asset('css/teacher/message.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="message-container">
    <h2>Messages</h2>
    <div class="messages-list">
        <p>No messages yet.</p>
        <!-- Placeholder for displaying messages -->
    </div>
    <div class="send-message">
        <form action="#" method="post">
            @csrf
            <input type="text" name="recipient" placeholder="Recipient" required>
            <textarea name="message" placeholder="Type your message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
</div>
@endsection