<?php

namespace App\Services;
use App\Interfaces\CommonInterface;
class TeacherService
{
    /**
     * Create a new class instance.
     */
    protected $teacherRepository;
    protected $userRepository;
    public function __construct(CommonInterface $teacherRepository, 
    CommonInterface $userRepository)
    {
        $this->teacherRepository = $teacherRepository;
        $this->userRepository = $userRepository;
    }

    public function getAllTeachers()
    {
        $teachers = $this->teacherRepository->getAll();  
        return $teachers;   
    }

    public function deleteTeacher($id)
    {       
        return \DB::transaction(function () use ($id) {
            return $this->teacherRepository->delete($id);
        });
    }
    public function getTeacher($id)
    {
        return $this->teacherRepository->findById($id);
    }

    public function updateteacher($id, array $teacherDetails , $image = null)
   {   
    $teacher = $this->teacherRepository->findById($id);
    if($image){
    if ($teacher->user->image) {
    $imagePath = public_path('storage/' . $teacher->user->image);
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $path = $image->store('profile_pictures', 'public');
    $teacherDetails['image'] = $path;
    }
   }
       
       return $this->teacherRepository->update($id, $teacherDetails);
   }

   public function registerTeacher(array $teacherDetails, $image = null)
   {
       return \DB::transaction(function () use ($teacherDetails, $image) {
           // Create user record first
           $userData = [
               'name' => $teacherDetails['name'],
               'email' => $teacherDetails['email'],
               'password' => bcrypt($teacherDetails['password']),
               'role' => 'teacher',
           ];
           
           if ($image) {
               $path = $image->store('teachers', 'public');
               $userData['image'] = $path;
           }
           
           $user = $this->userRepository->create($userData);
           
           // Create teacher record with user_id
           $teacherData = [
               'phone' => $teacherDetails['phone'] ?? null,
               'qualification' => $teacherDetails['qualification'] ?? null,
               'hire_date' => $teacherDetails['hire_date'] ?? null,
               'gender' => $teacherDetails['gender'] ?? null,
               'birth_date' => $teacherDetails['birth_date'] ?? null,
               'address' => $teacherDetails['address'] ?? null,
               'status' => $teacherDetails['status'] ?? null,
               'user_id' => $user->id,
           ];
           
           return \App\Models\Teacher::create($teacherData);
       });
   }
   
}
