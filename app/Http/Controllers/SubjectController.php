<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositeries\SubjectRepository;
use App\Repositeries\TeacherRepositry;
use App\Models\Subject;
use App\Models\Grade;
use App\Models\Section;
use App\Models\User;


class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $subjectRepository;
    protected $teacherRepository;
    
    public function __construct(SubjectRepository $subjectRepository,
    TeacherRepositry $teacherRepository)
    {
        $this->subjectRepository = $subjectRepository;
        $this->teacherRepository = $teacherRepository;
    }
    public function index()
    {
        $subjects = $this->subjectRepository->getAll();
        return view('subjects.index', compact('subjects'));
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('subjects.addSubjec');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $this->subjectRepository->create($request->only('name'));
        return redirect()->route('subjects.index')->with('success', 'Subject created successfully.');
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
        $subject = $this->subjectRepository->findById($id);
         return response()->json($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->subjectRepository->update($id, $request->only('name'));

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Subject updated successfully.',
                'subject' => $this->subjectRepository->findById($id),
            ]);
        }

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully.');
    }

    /** 
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $subject = $this->subjectRepository->findById($id);

        if (!$subject) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Subject not found'], 404);
            }
            return redirect()->route('subjects.index')->with('error', 'Subject not found.');
        }

        $this->subjectRepository->delete($id);

        if ($request->ajax()) {
            return response()->json(['message' => 'Subject deleted successfully.']);
        }

        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully.');
    }

    public function assignSubject(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);

        $teacher = $this->teacherRepository->findById($request->teacher_id);
        if (!$teacher) {
            return redirect()->back()->with('error', 'Selected teacher was not found.');
        }

        if (\DB::table('assign_subject_to_teacher')->where('subject_id', $request->subject_id)->exists()) {
            return redirect()->back()->with('info', 'This subject is already assigned to a teacher and cannot be assigned again.');
        }

        $teacher->subjects()->attach($request->subject_id);

        return redirect()->back()->with('success', 'Subject assigned successfully.');
    }
    
    public function toggleStatus(Request $request)
    {
        $subject = $this->subjectRepository->findById($request->id);

        if (!$subject) {
            return response()->json(['error' => 'Subject not found'], 404);
        }

        // toggle logic
        $subject->status = $request->status == 1 ? 0 : 1;
        $subject->save();

        return response()->json([
            'status' => $subject->status
        ]);
    }
     public function search(Request $request)
    {
        $query = $request->input('query');
        $subjects = Subject::where('name', 'LIKE', "{$query}%")->get();
        $users = User::where('name', 'LIKE', "{$query}%")->get();
        $grades = Grade::where('name', 'LIKE', "{$query}%")->get();
        $sections = Section::where('name', 'LIKE', "{$query}%")->get();
       return view('users.admin.searchAll', compact('subjects', 'users', 'grades', 'sections'));
    }
    public function searchResults(Request $request)
    {
        return view('users.admin.searchAll');
    }

    public function status($id)
    {
        $subject = $this->subjectRepository->findById($id);
       return response()->json($subject);
        // Toggle the status
        $subject->status = !$subject->status;
        $subject->save();

        return response()->json(['status' => $subject->status]);
    }

    
}
