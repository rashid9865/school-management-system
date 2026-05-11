<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="{{ asset('css/admin/update.css') }}">
</head>

<body>
    <div class="update_container">
        <h1>Update Student</h1>
        <form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $student->user->name }}" required>
            </div>
             <div>
                <label for="age">Father name:</label>
                <input type="text" id="father_name" name="fatner_name" value="{{ $student->father_name }}" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $student->user->email }}" required>
            </div>
            <div>
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" value="{{ $student->age }}" required>
            </div>
             <div>
                <label for="age">Address:</label>
                <input type="text" id="address" name="address" value="{{ $student->address}}" required>
            </div>
             <div>
                <label for="age">RollNo:</label>
                <input type="number" id="rollno" name="roll_no" value="{{ $student->roll_no }}" required>
            </div>
            <div>
                <label for="image">Profile Picture:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
</body>

</html>