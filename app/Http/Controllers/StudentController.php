<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\FeeStructure;
use App\Services\StudentService;
use App\Repositeries\StudentRepositry;
use App\Repositeries\TimeTableRepository;
use App\Repositeries\MessageRepository;

class StudentController extends Controller

{
    protected $studentRepository;
    protected $timeTableRepository;
    protected $messageRepository;

    public function __construct(StudentService $studentService, StudentRepositry $studentRepository, TimeTableRepository $timeTableRepository, MessageRepository $messageRepository)
    {
        $this->studentService = $studentService;
        $this->studentRepository = $studentRepository;
        $this->timeTableRepository = $timeTableRepository;
        $this->messageRepository = $messageRepository;
    }
    
    public function register()
    {
        return view('users.student.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'password' => 'required|string|confirmed',
            'father_name' =>  'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'age' => 'required|integer|min:1|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            'address' => 'required',
            'roll_no' => 'required|unique:students,roll_no',
        ],
        [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'password.required' => 'The password field is required.',

            'father_name.required' => 'The father name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            'age.required' => 'The age field is required.',
            'age.integer' => 'The age must be an integer.',
            'age.min' => 'The age must be at least 5.',
            'age.max' => 'The age may not be greater than 35.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 3000 kilobytes.',
            'address.required' => 'The address field is required.',
            'roll_no.required' => 'The roll number field is required.',
            'roll_no.unique' => 'The roll number has already been taken.',
         ]
        );
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('student_images', 'public');
            $request->merge(['image' => $imagePath]);
        }
        $this->studentRepository->create($request->only(['name', 'email','password','image','father_name', 'age', 'address', 'roll_no']), $request->file('image'));

        return redirect()->route('admin.dashboard')->with('success', 'Student registered successfully.');
    }
    protected function getAuthenticatedStudent()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403, 'You must be logged in to access the student dashboard.');
        }

        $student = $this->studentRepository->findByUserId($user->id);

        if (!$student && Schema::hasColumn('students', 'email')) {
            $student = $this->studentRepository->findByUserEmail($user->email);
        }

        if (!$student) {
            abort(404, 'Student profile not found.');
        }

        return $student;
    }

    protected function getClassFeeStructure($student)
    {
        if (!$student->grade_id && !$student->section_id) {
            return null;
        }

        if ($student->grade_id && $student->section_id) {
            $structure = FeeStructure::where('grade_id', $student->grade_id)
                ->where('section_id', $student->section_id)
                ->orderByDesc('id')
                ->first();

            if ($structure) {
                return $structure;
            }
        }

        if ($student->grade_id) {
            $structure = FeeStructure::where('grade_id', $student->grade_id)
                ->whereNull('section_id')
                ->orderByDesc('id')
                ->first();

            if ($structure) {
                return $structure;
            }
        }

        if ($student->section_id) {
            return FeeStructure::where('section_id', $student->section_id)
                ->whereNull('grade_id')
                ->orderByDesc('id')
                ->first();
        }

        return null;
    }

    public function dashboard()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent()->load([
            'grade.subjects.teachers.user',
            'section',
            'attendances',
            'marks.exam',
            'fees.feeStructure',
            'assignments.teacher',
        ]);

        $feeStructure = $this->getClassFeeStructure($student);
        $classFeeAmount = $feeStructure?->amount ?? 0;
        $feeStructureLabel = $feeStructure?->description ?? ($feeStructure?->type ? ucfirst(str_replace('_', ' ', $feeStructure->type)) : 'Class fee');

        $attendanceCount = $student->attendances->count();
        $presentCount = $student->attendances->where('status', 'present')->count();
        $absentCount = $student->attendances->where('status', 'absent')->count();
        $leaveCount = $student->attendances->where('status', 'leave')->count();
        $assignmentCount = $student->assignments->count();
        $unpaidFees = $student->fees->where('status', 'unpaid')->sum('amount');

        $nextExam = $student->marks
            ->map(fn($mark) => $mark->exam)
            ->filter()
            ->sortBy('exam_date_time')
            ->first();

        return view(
            'users.student.dashboard',
            compact(
                'student',
                'user',
                'attendanceCount',
                'presentCount',
                'absentCount',
                'leaveCount',
                'assignmentCount',
                'unpaidFees',
                'nextExam',
                'feeStructure',
                'classFeeAmount',
                'feeStructureLabel'
            )
        );
    }

    public function showStudent($id)
    {
        $student = $this->studentService->showStudent($id);
        return view('users.student.showStudent', compact('student'));
    }

    public function profile()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent()->load('grade', 'section');
        return view('users.student.profile', compact('student', 'user'));
    }

    public function attendence()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent();
        $attendances = $student->attendances()->orderBy('date', 'desc')->get();
        return view('users.student.attendence', compact('attendances', 'student', 'user'));
    }

    public function subject()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent()->load('grade.subjects.teachers.user');
        $subjects = $student->grade->subjects()->with('teachers.user')->get();
        return view('users.student.subject', compact('subjects', 'student', 'user'));
    }

    public function assignment()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent();
        $assignments = $student->assignments()->with('teacher')->get();
        return view('users.student.assignment', compact('assignments', 'student', 'user'));
    }

    public function timetable()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent();
        $timetables = $this->timeTableRepository->getByGradeId($student->grade_id);
        return view('users.student.timeTable', compact('timetables', 'student', 'user'));
    }

    public function result()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent();
        $marks = $student->marks()->with('subjects', 'exam')->get();
        return view('users.student.result', compact('marks', 'student', 'user'));
    }

    public function fees()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent();
        $fees = $student->fees()->with('feeStructure')->get();
        $feeStructure = $this->getClassFeeStructure($student);

        return view('users.student.fees', compact('fees', 'student', 'user', 'feeStructure'));
    }

    public function announce()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent();

        $announcements = $this->messageRepository->getAnnouncements();

        return view('users.student.announcement', compact('announcements', 'student', 'user'));
    }

    public function message()
    {
        $user = auth()->user();
        $student = $this->getAuthenticatedStudent();

        $messages = $this->messageRepository->getMessagesForStudent($student->id);

        return view('users.student.message', compact('messages', 'student', 'user'));
    }
    public function edit($id)
    {
        $student = $this->studentService->showStudent($id);
        return view('users.student.update', compact('student'));
    }
    
    public function allStudents()
    {
        $students = $this->studentService->getAllStudents();
        return view('users.student.allStudents', compact('students'));
    }

    public function update(Request $request, $id){

         $request->validate([
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'father_name' =>  'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'email' => 'required|email',
            'age' => 'required|integer|min:1|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3000',
            'address' => 'required',
            'roll_no' => 'required|integer|unique:students,roll_no,' . $id,
        ],
        [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'father_name.required' => 'The father name field is required.',
            'father_name.string' => 'The father name must be a string.',
            'father_name.max' => 'The father name may not be greater than 255 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'age.required' => 'The age field is required.',
            'age.integer' => 'The age must be an integer.',
            'age.min' => 'The age must be at least 5.',
            'age.max' => 'The age may not be greater than 35.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The image may not be greater than 3000 kilobytes.',
            'address.required' => 'The address field is required.',
            'roll_no.required' => 'The roll number field is required.',
            'roll_no.integer' => 'The roll number must be an integer.',
            'roll_no.unique' => 'The roll number has already been taken by another student.',
        ]
        );
        if($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('student_images', 'public');
            $request->merge(['image' => $imagePath]);
        }
       $this->studentRepository->update($id, $request->only(['name', 'email','father_name', 'age','image', 'address', 'roll_no']));

        return redirect()->route('admin.dashboard')->with('success', 'Student updated successfully.');
    }

    public  function destroy($id)
    {
        $this->studentService->deleteStudent($id);
        return redirect()->route('admin.dashboard')->with('success', 'Student deleted successfully.');
    }

    public function ajaxDestroy($id)
    {
        try {
            $this->studentService->deleteStudent($id);
            return response()->json([
                'success' => true,
                'message' => 'Student deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting student: ' . $e->getMessage()
            ], 500);
        }
    }

    public function layout()
    {
        return view('users.student.layout');
    }
}
