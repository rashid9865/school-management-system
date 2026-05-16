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
            'first_name' => $studentDetails['first_name'],
            'last_name' => $studentDetails['last_name'],
            'email' => $studentDetails['email'],
            'date_of_birth' => $studentDetails['date_of_birth'] ?? null,
            'image' => $studentDetails['image'] ?? null,
            'address' => $studentDetails['address'],
            'father_first_name' => $studentDetails['father_first_name'] ?? null,
            'father_last_name' => $studentDetails['father_last_name'] ?? null,
            'phone_no' => $studentDetails['phone_no'] ?? null,
            'father_age' => $studentDetails['father_age'] ?? null,
            'father_email' => $studentDetails['father_email'] ?? null,
            'father_address' => $studentDetails['father_address'] ?? null,
            'father_occupation' => $studentDetails['father_occupation'] ?? null,
            'mother_first_name' => $studentDetails['guardian_first_name'] ?? null,
            'mother_last_name' => $studentDetails['guardian_last_name'] ?? null,
            'mother_phone_no' => $studentDetails['guardian_phone_no'] ?? null,
            'mother_age' => $studentDetails['guardian_age'] ?? null,
            'mother_email' => $studentDetails['guardian_email'] ?? null,
            'mother_address' => $studentDetails['guardian_address'] ?? null,
            'mother_occupation' => $studentDetails['guardian_occupation'] ?? null,
        ]);
        return true;

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
            'first_name' => $studentDetails['first_name'],
            'last_name' => $studentDetails['last_name'],
            'email' => $studentDetails['email']?? 'N/A',
            'date_of_birth' => $studentDetails['date_of_birth'] ?? null,
            'image' => $studentDetails['image'] ?? $student->image,
            'address' => $studentDetails['address'],
            'father_first_name' => $studentDetails['father_first_name'] ?? $student->father_first_name,
            'father_last_name' => $studentDetails['father_last_name'] ?? $student->father_last_name,
            'phone_no' => $studentDetails['phone_no'] ?? $student->phone_no,
            'father_age' => $studentDetails['father_age'] ?? $student->father_age,
            'father_email' => $studentDetails['father_email'] ?? $student->father_email,
            'father_address' => $studentDetails['father_address'] ?? $student->father_address,
            'father_occupation' => $studentDetails['father_occupation'] ?? $student->father_occupation,
            'mother_first_name' => $studentDetails['guardian_first_name'] ?? $student->guardian_first_name,
            'mother_last_name' => $studentDetails['guardian_last_name'] ?? $student->guardian_last_name,
            'mother_phone_no' => $studentDetails['guardian_phone_no'] ?? $student->guardian_phone_no,
            'mother_age' => $studentDetails['guardian_age'] ?? $student->guardian_age,
            'mother_email' => $studentDetails['guardian_email'] ?? $student->guardian_email,
            'mother_address' => $studentDetails['guardian_address'] ?? $student->guardian_address,
            'mother_occupation' => $studentDetails['guardian_occupation'] ?? $student->guardian_occupation,
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
