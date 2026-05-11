
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Details</title>
    <link rel="stylesheet" href="{{ asset('css/showteacher.css') }}">
</head>
<body>
    <div class="container">
        <h1>Teacher Details</h1>
        <div class="student-info">
            @if(isset($teacher))
            <p><strong>Name:</strong> {{ $teacher->user->name }}</p>
            <p><strong>Email:</strong> {{ $teacher->user->email }}</p>
            <p><strong>Phone:</strong> {{ $teacher->phone }}</p>
            <p><strong>Qualification:</strong> {{ $teacher->qualification }}</p>
            <p><strong>Hire date:</strong> {{ $teacher->hire_date }}</p>
            @endif
        </div>
    </div> 
</body>
</html>