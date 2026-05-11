@extends('users.admin.layout')
@section('title')
<title>About Us</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('css/public/about.css') }}">
@endsection
@section('content')
<div class="about_container">
    <h1>About Us</h1>
    <p>Welcome to our student management system! We are dedicated to providing an easy-to-use platform for managing student information, including their profiles, courses, and academic progress. Our goal is to help educational institutions streamline their administrative tasks and enhance the overall student experience.</p>
    <h2>Our Mission</h2>
    <p>Our mission is to empower educational institutions with a comprehensive and user-friendly student management system that simplifies administrative processes and fosters a supportive learning environment for students.</p>
    <h2>Contact Us</h2>
    <p>If you have any questions or would like to learn more about our student management system, please feel free to contact us at <a href="mailto:support@university.edu">support@university.edu</a>.</p>
</div>
@endsection