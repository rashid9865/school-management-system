<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="{{ asset('css/showStudent.css') }}">
</head>
<body>
    <div class="container">
        <h1>Student Details</h1>
        <div class="student-info">
            <p><strong>Name:</strong> {{ $student->user->name }}</p>
            <p><strong>Email:</strong> {{ $student->user->email }}</p>
            <p><strong>Father's Name:</strong> {{ $student->father_name }}</p>
            <p><strong>Address:</strong> {{ $student->address }}</p>
            <p><strong>Age:</strong> {{ $student->age }}</p>
        </div>
    </div> 
</body>
</html>