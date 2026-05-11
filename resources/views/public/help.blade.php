@extends('users.admin.layout')
@section('title')
Help
@endSection
@section('css')
<link rel="stylesheet" href="{{ asset('css/public/help.css') }}">
@endSection
@section('content')
<div class="help_container">
    <h1>Help Page</h1>
    <p>Welcome to the help page! Here you can find answers to frequently asked questions and contact support for further assistance.</p>
    <h2>Frequently Asked Questions</h2>
    <ul>
        <li><strong>How do I create a student?</strong> Click on the "Create Student" button on the dashboard and fill out the form.</li>
        <li><strong>How do I edit a student?</strong> Click on the "Edit" link next to the student you want to edit, make your changes, and save.</li>
        <li><strong>How do I delete a student?</strong> Click on the "Delete" button next to the student you want to delete and confirm the action.</li>
    </ul>
    <h2>Contact Support</h2>
    <p>If you have any further questions or need assistance, please contact our support team at <a href="mailto:support@university.edu">support@university.edu</a>.</p>
</div>
@endsection