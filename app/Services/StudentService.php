<?php

namespace App\Services;
use App\Interfaces\CommonInterface;
class StudentService
{
    /**
     * Create a new class instance.
     */
    protected $studentRepository; 
    protected $userRepository;
    

    public function __construct(CommonInterface $studentRepository, 
    CommonInterface $userRepository)
    {        $this->studentRepository = $studentRepository;
        $this->userRepository = $userRepository;
    }
    public function getAllStudents()
   {
       return $this->studentRepository->getAll();
   } 
   public function showStudent($id)
   {
       return $this->studentRepository->show($id);
   }
   public function updateStudent($id, array $studentDetails , $image = null)
   {   
    $student = $this->studentRepository->findById($id);
    if($image){
    if ($student->image) {
    $imagePath = public_path('storage/' . $student->image);
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $path = $image->store('profile_pictures', 'public');
    $studentDetails['image'] = $path;
    }
   }
       
       return $this->studentRepository->update($id, $studentDetails);
   }

   public function deleteStudent($id)
   {   
       return \DB::transaction(function () use ($id) {
           return $this->studentRepository->delete($id);
       });
   }

   public function registerStudent(array $studentDetails, $image)
   {   
       return \DB::transaction(function () use ($studentDetails, $image) {
           // Create user record first
           $userData = [
               'name' => $studentDetails['name'],
               'email' => $studentDetails['email'],
               'password' => bcrypt($studentDetails['password']),
               'role' => 'student',
           ]; 
           
           if ($image) {
               $path = $image->store('profile_pictures', 'public');
               $userData['image'] = $path;
           }
           
           $user = $this->userRepository->create($userData);
           
           // Create student record with user_id
           $studentData = [
               'father_name' => $studentDetails['father_name'],
               'age' => $studentDetails['age'],
               'address' => $studentDetails['address'],
               'roll_no' => $studentDetails['roll_no'],
               'user_id' => $user->id,
           ];
           
           return \App\Models\Student::create($studentData);
       });
   }
}
