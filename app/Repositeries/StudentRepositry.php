<?php

namespace App\Repositeries;
use App\Models\Student;
use App\Interfaces\CommonInterface;
class StudentRepositry implements CommonInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function getAll()
    {
        return Student::with(['user', 'grade', 'section'])->get();
    }
    // Create a new student
    public function create(array $studentDetails)
    {
        return Student::create([
            'name' => $studentDetails['name'],
            'email' => $studentDetails['email'],
            'password' => bcrypt($studentDetails['password']),
            'father_name' => $studentDetails['father_name'],
            'age' => $studentDetails['age'],
            'address' => $studentDetails['address'],
            'roll_no' => $studentDetails['roll_no'],
            'image' => $studentDetails['image'] ?? null,
            'user_id' => auth()->id(),
        ]);

    }
    // Show a specific student
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return $student;
    }
    // Update a student

    public function update($id, array $studentDetails)
    {
        $student = Student::findOrFail($id);
        $student->update([
            'name' => $studentDetails['name'],
            'email' => $studentDetails['email'],
            'father_name' => $studentDetails['father_name'],
            'age' => $studentDetails['age'],
            'address' => $studentDetails['address'],
            'roll_no' => $studentDetails['roll_no'],
            'image' => $studentDetails['image'] ?? $student->image,
        ]);

        return true;
    }

    public function delete($id)
    {
        $student = Student::findOrFail($id);
            if ( $student->image) {
                $imagePath = public_path('storage/' . $student->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        $student->delete();
        return true;
    }

    public function findById($id)
    {
        return Student::findOrFail($id);
    }

    public function findByUserId($userId)
    {
        return Student::with(['grade', 'section', 'attendances', 'marks', 'fees', 'subjects', 'assignments'])
            ->where('user_id', $userId)
            ->first();
    }

    public function findByUserEmail($email)
    {
        return Student::with(['grade', 'section', 'attendances', 'marks', 'fees', 'subjects', 'assignments'])
            ->where('email', $email)
            ->first();
    }

}
