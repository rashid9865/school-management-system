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

    public function __construct(
        TimeTableRepository $timeTableRepo,
        SubjectRepository $subjectRepo,
        GradeRepository $gradeRepo,
        TimeManagementRepo $timeManagementRepo
    )
    {
        $this->timeTableRepo = $timeTableRepo;
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

        return view(
            'users.admin.createStudentTimetable',
            compact('subjects', 'grades', 'timeSlots')
        );
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

        // Prevent duplicate start time for same grade/day
        $exists = \App\Models\TimeTable::where('grade_id', $credentials['grade_id'])
            ->where('day', $credentials['day'])
            ->where('start_time', $credentials['start_time'])
            ->exists();

        if ($exists) {
            return redirect()
                ->back()
                ->with('error', 'This time slot is already assigned.');
        }

        unset($credentials['schedule_id']);

        $this->timeTableRepo->create($credentials);

        return redirect()
            ->back()
            ->with('success', 'Timetable entry created successfully!');
    }

    public function edit($id)
    {
        $timetableEntry = $this->timeTableRepo->findById($id);

        $subjects = $this->subjectRepo->getAll();
        $grades = $this->gradeRepo->getAll();
        $timeSlots = $this->timeManagementRepo->getAll();

        return view(
            'users.admin.editStudentTimetable',
            compact('timetableEntry', 'subjects', 'grades', 'timeSlots')
        );
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

        return redirect()
            ->back()
            ->with('success', 'Timetable entry updated successfully!');
    }

    // Get subjects by grade
    public function getSubjectsByGrade($gradeId)
    {
        $grade = \App\Models\Grade::find($gradeId);

        if (!$grade) {
            return response()->json([], 404);
        }

        $subjects = $grade->subjects()->get();
        
        return response()->json(
            $subjects->map(function ($subject) {
                return [
                    'name' => $subject->name
                ];
            })->values()
        );
    }

    // Get available start times
    public function getAvailableTimes(Request $request)
    {
        $gradeId = $request->grade_id;
        $subject = $request->subject;
        $day = $request->day;
        $scheduleId = $request->schedule_id;

        $schedule = \App\Models\TimeManagement::find($scheduleId);

        if (
            !$schedule ||
            !$schedule->start_time ||
            !$schedule->end_time
        ) {
            return response()->json([]);
        }

        if ($schedule->day != $day) {
            return response()->json([]);
        }

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

        // Already used start times
        $existing = \App\Models\TimeTable::where('grade_id', $gradeId)
            ->where('day', $day)
            ->whereNotNull('start_time')
            ->pluck('start_time')
            ->toArray();

        $available = array_diff($times, $existing);

        return response()->json(array_values($available));
    }

    // FIXED SUBJECT API
    public function getAvailableSubjects(Request $request)
    {
        $gradeId = $request->grade_id;
        $day = $request->day;
        $grade = \App\Models\Grade::find($gradeId);

        if (!$grade) {
            return response()->json([]);
        }

        // Get all subjects assigned to grade
        $allSubjects = $grade->subjects;

        if (!$allSubjects || $allSubjects->count() === 0) {
            return response()->json([]);
        }

        // If no day selected show ALL subjects
        if (!$day) {
            return response()->json(
                $allSubjects->map(function ($subject) {
                    return [
                        'id' => $subject->id,
                        'name' => $subject->name,
                    ];
                })->values()
            );
        }

        /*
        IMPORTANT FIX:
        Only exclude subjects that already have:
        start_time AND end_time

        If start_time or end_time is NULL
        subject should still appear.
        */

        $completedSubjects = \App\Models\TimeTable::where('grade_id', $gradeId)
            ->where('day', $day)
            ->whereNotNull('start_time')
            ->whereNotNull('end_time')
            ->pluck('subject')
            ->toArray();

        // Show subjects NOT fully completed
        $availableSubjects = $allSubjects->filter(function ($subject) use ($completedSubjects) {

            return !in_array($subject->name, $completedSubjects);

        });

        return response()->json(
            $availableSubjects->map(function ($subject) {
                return [
                    'id' => $subject->id,
                    'name' => $subject->name,
                ];
            })->values()
        );
    }

    public function destroy($id)
    {
        $this->timeTableRepo->delete($id);

        return redirect()
            ->back()
            ->with('success', 'Timetable entry deleted successfully!');
    }
}