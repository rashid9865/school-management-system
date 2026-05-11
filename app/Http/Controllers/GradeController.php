<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositeries\GradeRepository;
use App\Services\StudentService;
use App\Repositeries\SubjectRepository;

class GradeController extends Controller
{
   protected $gradeRepository;
   protected $studentService;
   protected $subjectRepository;
    public function __construct(GradeRepository $gradeRepository,StudentService $studentService, SubjectRepository $subjectRepository)
    {
        $this->gradeRepository = $gradeRepository;
        $this->studentService = $studentService;
        $this->subjectRepository = $subjectRepository;
    }

    public function index()
    {
        $grades = $this->gradeRepository->getAll();
        return view('grades.index' , compact('grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('grades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $this->gradeRepository->create($request->only(['name','description']));
        
        $grades = $this->gradeRepository->getAll();
        return redirect()->route('grades.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function assignStudent()
    {
        // Only show students that are not yet assigned to any grade
        $students = \App\Models\student::with('user')
            ->whereNull('grade_id')
            ->get();
        $grades = $this->gradeRepository->getAll();
        return view('grades.assignStudent', compact('students', 'grades'));
    }

    public function studentAssigned(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'student_id' => 'required|exists:students,id',
        ]);

        $student = \App\Models\student::find($request->student_id);
        if (!$student) {
            return redirect()->back()->with('error', 'Selected student was not found.');
        }

        if ($student->grade_id) {
            return redirect()->back()->with('error', 'This student is already assigned to a grade. Remove the current assignment first before assigning another grade.');
        }

        $student->grade_id = $request->grade_id;
        $student->save();

        return redirect()->back()->with('success', 'Student assigned to grade successfully!');
    }

    // Assign subjects to a grade
    public function assignSubjects()
    {
        $grades = $this->gradeRepository->getAll();
        // Only show subjects that are not yet assigned to any grade
        $assignedSubjectIds = \DB::table('grade_subject')->pluck('subject_id')->toArray();
        $subjects = $this->subjectRepository->getAll()->whereNotIn('id', $assignedSubjectIds);
        
        return view('grades.assignSubjects', compact('grades', 'subjects'));
    }

    // Store subject assignment to grade
    public function storeSubjectAssignment(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $grade = \App\Models\grade::find($request->grade_id);
        
        // Check if subject is already assigned to any grade
        $isAssigned = \DB::table('grade_subject')->where('subject_id', $request->subject_id)->exists();
        
        if ($isAssigned) {
            return redirect()->back()->with('error', 'This subject is already assigned to another grade. A subject can only be assigned to one grade.');
        }
        
        // Check if already assigned to this grade (though unlikely since we filter)
        if (!$grade->subjects()->where('subject_id', $request->subject_id)->exists()) {
            $grade->subjects()->attach($request->subject_id);
            return redirect()->back()->with('success', 'Subject assigned to grade successfully!');
        }

        return redirect()->back()->with('info', 'Subject already assigned to this grade!');
    }

    // Remove subject assignment from grade
    public function removeSubjectAssignment($gradeId, $subjectId)
    {
        $grade = \App\Models\grade::find($gradeId);
        
        if ($grade) {
            $grade->subjects()->detach($subjectId);
            return redirect()->back()->with('success', 'Subject removed from grade!');
        }

        return redirect()->back()->with('error', 'Grade not found!');
    }

    public function getSubjectsByGrade($gradeId)
    {
        $grade = \App\Models\grade::find($gradeId);
        if (!$grade) {
            return response()->json([]);
        }
        return response()->json($grade->subjects->map(function ($subject) {
            return ['name' => $subject->name];
        }));
    }
}
