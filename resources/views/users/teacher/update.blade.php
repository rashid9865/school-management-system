<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Teacher</title>
    <link rel="stylesheet" href="{{ asset('css/admin/update.css') }}">
</head>

<body>
    <div class="update_container">
        <h1>Update Teacher</h1>
        <form action="{{ route('teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $teacher->name }}" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="{{ $teacher->email }}" required>
            </div>
             <div>
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="{{ $teacher->phone}}" required>
            </div>
             <div>
                <label for="qualification">Qualification:</label>
                <input type="text" id="qualification" name="qualification" value="{{ $teacher->qualification }}" required>
            </div>
             <div>
                <label for="hire_date">Hire Date:</label>
                <input type="date" id="hire_date" name="hire_date" value="{{ $teacher->hire_date }}" required>
            </div>
            <div>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="">Select Gender</option>
                    <option value="male" {{ $teacher->gender == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ $teacher->gender == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ $teacher->gender == 'other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>
            <div>
                <label for="birth_date">Birth Date:</label>
                <input type="date" id="birth_date" name="birth_date" value="{{ $teacher->birth_date }}">
            </div>
            <div>
                <label for="address">Address:</label>
                <textarea id="address" name="address">{{ $teacher->address }}</textarea>
            </div>
            <div>
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="active" {{ $teacher->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ $teacher->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
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