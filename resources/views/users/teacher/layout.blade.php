<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | School Management</title>
    <link rel="stylesheet" href="{{ asset('css/teacher/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/teacher/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/teacher/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/teacher/footer.css') }}">
    @yield('css')
</head>

<body class="app-body">
    <div class="container">
        <div class="child-container header-container">
            @include('users.teacher.header')
        </div>
        <div class="child-container sidebar-container">
            @include('users.teacher.sidebar')
        </div>
        <div class="child-container main-container">
            @yield('content')
        </div>
        <div class="child-container footer-container">
            @include('users.teacher.footer')
        </div>
    </div>
    @yield('js')
</body>

</html>