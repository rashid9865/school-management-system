<?php

namespace App\Services;

use App\Repositeries\StudentRepositry;
use App\Repositeries\TeacherRepositry;
use App\Repositeries\AdminRepositry;
use App\Repositeries\UserRepository;        
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class UserService
{
    /**
     * Create a new class instance.
     */
    protected $studentRepository;
    protected $teacherRepository;
    protected $adminRepository;
    protected $userRepository;
    public function __construct(StudentRepositry $studentRepository, 
    TeacherRepositry $teacherRepository,
    AdminRepositry $adminRepository,
    UserRepository $userRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->teacherRepository = $teacherRepository;
        $this->adminRepository = $adminRepository;
        $this->userRepository = $userRepository;
    }

    public function register($data, $image)   
    {
       $path = $image->store('profile_pictures', 'public');
       
         $data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'image' => $path,
        ];
        return $this->adminRepository->create($data);
      }
    //   elseif($data['role'] == 'student'){

    //      return DB::transaction(function () use ($data, $path) {
    //          $userData = [
    //              'name' => $data['name'],
    //              'email' => $data['email'],
    //              'password' => bcrypt($data['password']),
    //              'role' => $data['role'],
    //              'image' => $path,
    //          ];

    //          $user = $this->userRepository->create($userData);
    //          $studentData = [
    //              'user_id' => $user->id,
    //              'father_name' => $data['father_name'],
    //              'address' => $data['address'],
    //              'age' => $data['age'],
    //              'roll_no' => $data['roll_no'],
    //              'grade_id' => $data['grade_id'] ?? null,
    //              'section_id' => $data['section_id'] ?? null,
    //          ];
    //          return $this->studentRepository->create($studentData);
    //          dd($studentData);
    //      });
    //   }
    //   elseif($data['role'] == 'teacher'){
    //       return DB::transaction(function () use ($data, $path) {
    //          $userData = [
    //              'name' => $data['name'],
    //              'email' => $data['email'],
    //              'password' => bcrypt($data['password']),
    //              'role' => $data['role'],
    //              'image' => $path,
    //          ];
    //          $user = $this->userRepository->create($userData);
    //          $teacherData = [
    //              'user_id' => $user->id,
    //              'phone' => $data['phone'],
    //              'qualification' => $data['qualification'],
    //              'hire_date' => $data['hire_date'],
    //          ];
    //          return $this->teacherRepository->create($teacherData);
    //      });
//       }
//    }
   
   public function login($credentials)
   {
         if (Auth::attempt($credentials)) {

           if(Auth::user()->role == 'admin'){
             return redirect()->route('admin.dashboard');
           }
           elseif(Auth::user()->role == 'student'){
             return redirect()->route('student.dashboard');
           }
           elseif(Auth::user()->role == 'teacher'){
             return redirect()->route('teacher.dashboard');
           }
         }
         return false;
   }

   public function logout()
   {
       Auth::logout();
       return redirect()->route('login');
   }

}
 
