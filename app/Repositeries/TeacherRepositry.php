<?php

namespace App\Repositeries;
use App\Interfaces\CommonInterface;
use App\Models\Teacher;
class TeacherRepositry implements CommonInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct( )
    {
        //
    }
    public function getAll()
    {
        return Teacher::with('user')->get();
    }   

    public function create(array $teacherDetails)
    {
        return Teacher::create([
            'name' => $teacherDetails['name'],
            'email' => $teacherDetails['email'],
            'phone' => $teacherDetails['phone'] ?? null,
            'qualification' => $teacherDetails['qualification'] ?? null,
            'hire_date' => $teacherDetails['hire_date'] ?? null,
            'password' => bcrypt($teacherDetails['password']) ?? bcrypt('defaultpassword'),
            'gender' => $teacherDetails['gender'] ?? null,
            'birth_date' => $teacherDetails['birth_date'] ?? null,
            'address' => $teacherDetails['address'] ?? null,
            'status' => $teacherDetails['status'] ?? null,
            'image' => $teacherDetails['image'] ?? null,
            'user_id' =>auth()->id(),
        ]);
    }
    public function update($id, array $teacherDetails)
    {
        $teacher = Teacher::find($id);

        $teacher->update([  
             'name' => $teacherDetails['name'], 
            'email' => $teacherDetails['email'],
            'phone' => $teacherDetails['phone'] ?? null,
            'qualification' => $teacherDetails['qualification'] ?? null,
            'hire_date' => $teacherDetails['hire_date'] ?? null,
            'gender' => $teacherDetails['gender'] ?? null,
            'birth_date' => $teacherDetails['birth_date'] ?? null,
            'address' => $teacherDetails['address'] ?? null,
            'status' => $teacherDetails['status'] ?? null,
            'image' => $teacherDetails['image'] ?? null,
            'user_id' =>auth()->id(),
        ]);
        return true;
    }
    public function findById($id)
    {
        $teacher = Teacher::with('user')->find($id);
        return $teacher;
    }   
    public function delete($id)
    {
        $teacher = Teacher::with('user')->find($id);
        if ($teacher) {
            if ($teacher->user) {
                $teacher->user->delete();
            }
            $teacher->delete();
            return true;
        }
        return false;   
    }
    public function show($id)
    {
        return Teacher::with('user')->findOrFail($id);
    }
}
