<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositeries\TimeTableRepository;
use App\Repositeries\SubjectRepository;
use App\Repositeries\GradeRepository;
use App\Repositeries\TimeManagementRepo;

class TimetableController extends Controller
{
    protected $timeTableRepo;
    protected $subjectRepo;
    protected $gradeRepo;
    protected $timeManagementRepo;

    public function __construct(TimeTableRepository $timeTableRepo,SubjectRepository $subjectRepo,GradeRepository $gradeRepo,TimeManagementRepo $timeManagementRepo)
    {
        $this->timeTableRepo = $timeTableRepo ;
        $this->subjectRepo = $subjectRepo;
        $this->gradeRepo = $gradeRepo;
        $this->timeManagementRepo = $timeManagementRepo;
    }

    public function index()
    {
        $timetables = $this->timeTableRepo->getAll();
        $grades = $this->gradeRepo->getAll();
       
        return view('users.admin.timetables.index', compact('timetables', 'grades'));
    }

    public function create()
    {
        $subjects = $this->subjectRepo->getAll();
        $grades = $this->gradeRepo->getAll();
        $timeSlots = $this->timeManagementRepo->getAll();
        return view('users.admin.createStudentTimetable',compact('subjects','grades','timeSlots'));
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'schedule_id' => 'required|exists:time_management,id',
            'subject' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'grade_id' => 'required',
       ]);
       
        // Check if this time slot is already assigned for this grade on this day
        $exists = \App\Models\TimeTable::where('grade_id', $credentials['grade_id'])
            ->where('day', $credentials['day'])
            ->where('start_time', $credentials['start_time'])
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This time slot is already assigned for the selected grade, subject, and day.');
        }

        // We store only the selected timetable values, schedule_id is used for validation.
        unset($credentials['schedule_id']);

        $this->timeTableRepo->create($credentials);
        return redirect()->back()->with('success', 'Timetable entry created successfully!');

    }

    public function edit($id)
    {
        $timetableEntry = $this->timeTableRepo->findById($id);
        $subjects = $this->subjectRepo->getAll();
        $grades = $this->gradeRepo->getAll();
        $timeSlots = $this->timeManagementRepo->getAll();
        return view('users.admin.editStudentTimetable', compact('timetableEntry', 'subjects', 'grades', 'timeSlots'));
    }

    public function update(Request $request, $id)
    {
        $credentials = $request->validate([
            'subject_id' => 'required',
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'grade_id' => 'required',
        ]);

        $this->timeTableRepo->update($id, $credentials);
        return redirect()->back()->with('success', 'Timetable entry updated successfully!');
    }

    // API endpoint to get subjects for a grade
    public function getSubjectsByGrade($gradeId)
    {
        $grade = \App\Models\grade::find($gradeId);
        
        if (!$grade) {
            return response()->json([], 404);
        }

        // Get all subjects assigned to this grade
        $subjects = $grade->subjects()->get();

        return response()->json($subjects->map(function ($subject) {
            return ['name' => $subject->name];
        })->values());
    }

    public function getAvailableTimes(Request $request)
    {
        $gradeId = $request->grade_id;
        $subject = $request->subject;
        $day = $request->day;
        $scheduleId = $request->schedule_id;

        $schedule = \App\Models\TimeManagement::find($scheduleId);
        if (!$schedule || !$schedule->start_time || !$schedule->end_time) {
            return response()->json([]);
        }

        if ($schedule->day != $day) {
            return response()->json([]);
        }

        // Build all possible start times
        $start = strtotime($schedule->start_time);
        $end = strtotime($schedule->end_time);
        if ($start >= $end) {
            return response()->json([]);
        }

        $period = ($schedule->period_minutes ?? 60) * 60;
        if ($period <= 0) {
            return response()->json([]);
        }

        $times = [];
        for ($time = $start; $time < $end; $time += $period) {
            $times[] = date('H:i', $time);
        }

        // Get existing start_times for this grade, day (any subject)
        $existing = \App\Models\TimeTable::where('grade_id', $gradeId)
            ->where('day', $day)
            ->pluck('start_time')
            ->toArray();

        $available = array_diff($times, $existing);
        return response()->json(array_values($available));
    }

    public function getAvailableSubjects(Request $request)
    {
        $gradeId = $request->grade_id;
        $day = $request->day;

        $grade = \App\Models\grade::find($gradeId);
        if (!$grade) {
            return response()->json([]);
        }

        $allSubjects = $grade->subjects;

        if (!$day) {
            return response()->json($allSubjects->map(function ($subject) {
                return ['name' => $subject->name];
            })->values());
        }

        // Get subjects that already have a slot on this day for this grade
        $assignedSubjects = \App\Models\TimeTable::where('grade_id', $gradeId)
            ->where('day', $day)
            ->pluck('subject')
            ->unique()
            ->toArray();

        $available = $allSubjects->filter(function ($subject) use ($assignedSubjects) {
            return !in_array($subject->name, $assignedSubjects);
        });

        return response()->json($available->map(function ($subject) {
            return ['name' => $subject->name];
        }));
    }

    public function destroy($id)
    {
        $this->timeTableRepo->delete($id);
        return redirect()->back()->with('success', 'Timetable entry deleted successfully!');
    }
}
