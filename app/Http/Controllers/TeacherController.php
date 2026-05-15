<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Services\TeacherService;
use App\Repositeries\TeacherRepositry;
use App\Services\UserService;
use App\Services\TeacherAttendanceService;
use App\Repositeries\SubjectRepository;
use App\Repositeries\AssignmentRepositry;
use App\Repositeries\ExamRepositry;
use App\Repositeries\MarkRepositry;
use App\Repositeries\AttendendRepository;
use App\Repositeries\TeacherTimeTableRepository;
use App\Repositeries\TeacherAttendanceRepository;
use App\Models\Attendend;
use App\Http\Requests\StoreTeacherAttendanceRequest;
use App\Http\Requests\ApproveTeacherAttendanceRequest;
use Carbon\Carbon;
use App\Repositeries\StudentRepositry;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    protected $studentRepository;   
    protected $teacherRepository;
    protected $teacherService;
    protected $userService;
    protected $subjectRepository;
    protected $assignmentRepository;
    protected $examRepository;
    protected $markRepository;
    protected $attendanceRepository;
    protected $timetableRepository;
    protected $teacherAttendanceRepository;
    protected $attendanceService;

    public function __construct(
        TeacherRepositry $teacherRepository,
        TeacherService $teacherService,
        UserService $userService,
        SubjectRepository $subjectRepository,
        AssignmentRepositry $assignmentRepository,
        ExamRepositry $examRepository,
        MarkRepositry $markRepository,
        AttendendRepository $attendanceRepository,
        TeacherTimeTableRepository $timetableRepository,
        TeacherAttendanceRepository $teacherAttendanceRepository,
        TeacherAttendanceService $attendanceService,
        StudentRepositry $studentRepository
    )
    {
        $this->teacherRepository = $teacherRepository;
        $this->teacherService = $teacherService;
        $this->userService = $userService;
        $this->subjectRepository = $subjectRepository;
        $this->assignmentRepository = $assignmentRepository;
        $this->examRepository = $examRepository;
        $this->markRepository = $markRepository;
        $this->attendanceRepository = $attendanceRepository;
        $this->timetableRepository = $timetableRepository;
        $this->teacherAttendanceRepository = $teacherAttendanceRepository;
        $this->attendanceService = $attendanceService;
        $this->studentRepository = $studentRepository;
    }
    public function register()
    {
        return view('users.teacher.register');
    }
    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'phone' => 'required|numeric',
            'qualification' => 'required',
            'hire_date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            'gender' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
            'status' => 'nullable|string',
        ],
        [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.regex' => 'The name may only contain letters and spaces.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'The password field is required.',
            'password.confirmed' => 'The password confirmation does not match.',
            'phone.required' => 'The phone field is required.',
            'qualification.required' => 'The qualification field is required.',
            'hire_date.required' => 'The hire date field is required.',
            'hire_date.date' => 'The hire date must be a valid date.',
        ]
        );
        
        $this->teacherService->registerTeacher(
            $request->only(['name', 'email','phone', 'qualification', 'hire_date', 'password', 'gender', 'birth_date', 'address', 'status']),
            $request->file('image')
        );
        
        return redirect()->route('admin.dashboard')->with('success', 'Teacher registered successfully.');
    }
    public function login()
    {
        return view('users.teacher.login');
    }
    public function loginTeacher(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
        [
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'password.required' => 'The password field is required.',
        ]
        );

      if (Auth::guard('teacher')->attempt($credentials)) {
    return redirect()->route('teacher.dashboard')->with('success', 'Logged in successfully!');
} else {
    return back()->with('error', 'Invalid credentials');
}
        

    }
    public function dashboard()
    {
        
      $students = $this->studentRepository->getAll();
      $subjects = $this->subjectRepository->getAll();
      $assignments = $this->assignmentRepository->getAll();
      $exams = $this->examRepository->getAll();
      $marks = $this->markRepository->getAll();
      $attendances = $this->attendanceRepository->getAll();
      $timetables = $this->timetableRepository->getAll();   
    
       return view('users.teacher.dashboard', compact('students', 'subjects', 'assignments', 'exams', 'marks', 'attendances', 'timetables'));
    }

    public function storeAssignment(Request $request)
    {
        $user = auth()->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(404, 'Teacher profile not found.');
        }

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:start_date',
            'assignment_file' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:5120',
            'action' => 'nullable|string|max:1000',
        ]);

        $subject = $teacher->subjects()->findOrFail($request->subject_id);
        $filePath = null;

        if ($request->hasFile('assignment_file')) {
            $filePath = $request->file('assignment_file')->store('assignments', 'public');
        }

        $assignment = $this->assignmentRepository->create([
            'teacher_id' => $teacher->id,
            'course_name' => $subject->name,
            'start_date' => $request->start_date,
            'due_date' => $request->due_date,
            'assignment_file' => $filePath,
            'action' => $request->action ?? '',
            'student_id' => null,
        ]);

        $studentIds = $subject->students()->pluck('students.id')->toArray();
        if (!empty($studentIds)) {
            $assignment->students()->sync($studentIds);
        }

        return redirect()->route('teacher.assignments')->with('success', 'Assignment created and shared with enrolled students.');
    }

    public function storeAttendance(Request $request)
    {
        $user = auth()->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(404, 'Teacher profile not found.');
        }

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
            'statuses' => 'required|array',
            'statuses.*' => 'required|in:present,absent,leave',
        ]);

        $subject = $teacher->subjects()->findOrFail($request->subject_id);
        $studentIds = $subject->students()->pluck('students.id')->toArray();

        foreach ($studentIds as $studentId) {
            if (!isset($request->statuses[$studentId])) {
                continue;
            }

            Attendend::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'subject' => $subject->name,
                    'date' => $request->date,
                ],
                [
                    'status' => $request->statuses[$studentId],
                ]
            );
        }

        return redirect()->route('teacher.attendance')->with('success', 'Attendance recorded for ' . $subject->name . '.');
    }

    public function allTeachers()
    {
        $teachers = $this->teacherRepository->getAll();
        return view('users.teacher.allTeachers', compact('teachers'));
    }

    public function layout()
    {
        return view('users.teacher.layout');
    }

    public function classes()
    {
        $user = auth()->user();
        $teacher = $user->teacher;
        $subjects = $teacher->subjects;
        return view('users.teacher.teacherclasses', compact('teacher', 'user', 'subjects'));
    }

    public function seeStudent()
    {
        $user = auth()->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(404, 'Teacher profile not found.');
        }

        $gradeIds = $teacher->subjects
            ->flatMap(fn($subject) => $subject->grades)
            ->pluck('id')
            ->unique()
            ->filter()
            ->values();

        $students = Student::with('user')
            ->whereIn('grade_id', $gradeIds)
            ->get();

        return view('users.teacher.tseestudent', compact('teacher', 'user', 'students'));
    }

    public function attendence()
    {
        $user = auth()->user();
        $teacher = $user->teacher;
        $subjects = $teacher->subjects ?? collect();
        $students = $subjects->flatMap(fn($subject) => $subject->students)->unique('id');
        $attendances = $this->attendanceRepository->getByStudentIds($students->pluck('id')->toArray());

        return view('users.teacher.attendence', compact('teacher', 'user', 'attendances', 'subjects', 'students'));
    }

    public function selfAttendance()
    {
        $user = auth()->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(404, 'Teacher profile not found.');
        }

        // Get current month's attendance
        $attendances = $this->teacherAttendanceRepository->getAttendanceForCurrentMonth($teacher->id);
        
        // Get statistics
        $stats = $this->attendanceService->getAttendanceStats(
            $teacher->id,
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );

        // Check if already marked today
        $todayStatus = $this->attendanceService->getTodayStatus($teacher->id);

        return view('users.teacher.self_attendance', compact(
            'teacher',
            'user',
            'attendances',
            'stats',
            'todayStatus'
        ));
    }

    public function storeSelfAttendance(StoreTeacherAttendanceRequest $request)
    {
        $user = auth()->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(404, 'Teacher profile not found.');
        }

        // Check if attendance already exists for this date
        if ($this->teacherAttendanceRepository->hasConflict($teacher->id, $request->date)) {
            return redirect()
                ->route('teacher.self.attendance')
                ->with('error', 'آپ نے اس تاریخ کے لیے پہلے سے حاضری درج کر رکھی ہے۔');
        }

        try {
            $attendance = $this->attendanceService->recordAttendance([
                'teacher_id' => $teacher->id,
                'date' => $request->date,
                'status' => $request->status,
                'time_in' => $request->time_in,
                'time_out' => $request->time_out,
                'notes' => $request->notes,
                'approval_status' => 'pending',
            ]);

            return redirect()
                ->route('teacher.self.attendance')
                ->with('success', 'آپ کی حاضری کامیابی سے درج ہو گئی۔ منتظر ہے منظوری کے لیے۔');
        } catch (\Exception $e) {
            return redirect()
                ->route('teacher.self.attendance')
                ->with('error', 'حاضری درج کرتے وقت خرابی پیش آئی۔');
        }
    }

    /**
     * Show attendance history with filters
     */
    public function attendanceHistory()
    {
        $user = auth()->user();
        $teacher = $user->teacher;

        if (!$teacher) {
            abort(404, 'Teacher profile not found.');
        }

        $startDate = request('start_date', Carbon::now()->subMonths(3)->toDateString());
        $endDate = request('end_date', Carbon::now()->toDateString());

        $attendances = $this->teacherAttendanceRepository->getByTeacherIdAndDateRange(
            $teacher->id,
            $startDate,
            $endDate
        );

        $stats = $this->attendanceService->getAttendanceStats(
            $teacher->id,
            $startDate,
            $endDate
        );

        return view('users.teacher.attendance_history', compact(
            'teacher',
            'user',
            'attendances',
            'stats',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Admin: Approve or reject attendance
     */
    public function approveAttendance(ApproveTeacherAttendanceRequest $request, $id)
    {
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Unauthorized');
        }

        try {
            if ($request->approval_status === 'approved') {
                $this->attendanceService->approveAttendance(
                    $id,
                    auth()->id(),
                    $request->remarks ?? null
                );

                return redirect()->back()->with('success', 'حاضری منظور کر دی گئی۔');
            } else {
                $this->attendanceService->rejectAttendance(
                    $id,
                    auth()->id(),
                    $request->remarks
                );

                return redirect()->back()->with('success', 'حاضری مسترد کر دی گئی۔');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'منظوری میں خرابی: ' . $e->getMessage());
        }
    }

    /**
     * Admin: View pending approvals
     */
    public function pendingApprovals()
    {

        $pendingAttendances = $this->teacherAttendanceRepository->getPendingApprovals(100);

        return view('admin.attendance_approvals', compact('pendingAttendances'));
    }

    public function subject()
    {
        $teacher = auth('teacher')->user();
        $subjects = $teacher->subjects;
        return view('users.teacher.subject', compact('teacher', 'user', 'subjects'));
    }

    public function assignment()
    {
        $user = auth('teacher')->user();
        $teacher = $user->teacher;
        $subjects = $teacher->subjects ?? collect();
        $assignments = $this->assignmentRepository->getByTeacherId($teacher->id);
        return view('users.teacher.assignment', compact('teacher', 'user', 'assignments', 'subjects'));
    }

    public function exam()
    {
        $teacher = auth('teacher')->user();
        $exams = $this->examRepository->getAll();
        return view('users.teacher.exam', compact('teacher', 'exams'));
    }

    public function marks()
    {
       
        $teacher = auth('teacher')->user();
        $students = $teacher->students;
        $marks = $this->markRepository->getByStudentIds($students->pluck('id')->toArray());
        return view('users.teacher.marks', compact('teacher', 'marks'));
    }

    public function studymeterial()
    {
        return view('users.teacher.studymeterial');
    }

    public function timetable()
    {
        $teacher = auth('teacher')->user();
        $timetables = $this->timetableRepository->getByTeacherId($teacher->id);
        return view('users.teacher.timetable', compact('teacher', 'user', 'timetables'));
    }

    public function announce()
    {
        return view('users.teacher.announcement');
    }

    public function message()
    {
        return view('users.teacher.message');
    }

    public function profile()
    {
        $teacher = auth('teacher')->user();
        return view('users.teacher.profile', compact('teacher'));
    }
    
    public function deleteTeacher($id)
    {
        $this->teacherRepository->delete($id);
        return redirect()->route('admin.dashboard')->with('success', 'Teacher deleted successfully.');
    }

    public function show($id)
    {
        $teacher = $this->teacherRepository->findById($id);
        return view('users.teacher.show', compact('teacher'));
    }

    public function edit($id)
    {
        $teacher = $this->teacherRepository->findById($id);
        return view('users.teacher.update', compact('teacher'));
    }

    public function update(Request $request ,$id)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            'phone' => 'required',
            'qualification' => 'required',
            'hire_date' => 'required|date',
            'gender' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
        ],
        
        [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.regex' => 'The name may only contain letters and spaces.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.required' => 'The phone field is required.',
            'qualification.required' => 'The qualification field is required.',
            'hire_date.required' => 'The hire date field is required.',
            'hire_date.date' => 'The hire date must be a valid date.',
        ]);
         $this->teacherRepository->update($id, $request->only(['name', 'email','phone', 'qualification', 'hire_date', 'gender', 'birth_date', 'address', 'status']));

        return redirect()->route('admin.dashboard')->with('success', 'Teacher updated successfully.');
    }

    public function ajaxDestroy($id)
    {
        try {
            $this->teacherRepository->delete($id);
            return response()->json([
                'success' => true,
                'message' => 'Teacher deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting teacher: ' . $e->getMessage()
            ], 500);
        }
    }
}
