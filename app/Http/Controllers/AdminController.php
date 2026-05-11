<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use App\Services\TeacherService;

class AdminController extends Controller
{
    protected $studentService;
    protected $teacherService;

    public function __construct(
        StudentService $studentService,
        TeacherService $teacherService
    )
    {
        $this->studentService = $studentService;
        $this->teacherService = $teacherService;
    }
    // Dashboard for admin
    public function dashboard()
    {
        $students = $this->studentService->getAllStudents();
        $user = auth()->user();
        $teachers = $this->teacherService->getAllTeachers();
        return view('users.admin.dashboard', get_defined_vars());
    }
}

