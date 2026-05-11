<!DOCTYPE html>
<html>

<head>
    <title>Profile Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin/profile_info.css') }}">
</head>

<body>
    <div class="profile-container" id="menu">
        <img src="{{ asset('storage/'.$student->image) }}" alt="Profile Picture" class="profile-image">
        <div>
            <p><strong>Name:</strong> {{ $student->name }}</p>
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Age:</strong> {{ $student->age }}</p>
        </div>
    </div>
</body>

</html>