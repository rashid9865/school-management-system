<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use App\Services\TeacherService;
use App\Repositeries\SubjectRepository;

class AdminController extends Controller
{
    protected $studentService;
    protected $teacherService;
    protected $subjectRepo;

    public function __construct(
        StudentService $studentService,
        TeacherService $teacherService,
        SubjectRepository $subjectRepo,
    )
    {
        $this->studentService = $studentService;
        $this->teacherService = $teacherService;
        $this->subjectRepo = $subjectRepo;
    }
    // Dashboard for admin
    public function dashboard()
    {
        $students = $this->studentService->getAllStudents();
        $user = auth()->user();
        $teachers = $this->teacherService->getAllTeachers();
        $subjects = $this->subjectRepo->getAll();
        return view('users.admin.dashboard', get_defined_vars());
    }
}

