<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\TeacherAttendance;
use Carbon\Carbon;

class TeacherAttendanceRepository implements CommonInterface
{
    public function getAll()
    {
        return TeacherAttendance::with(['teacher', 'approvedBy'])->latest('date')->get();
    }

    public function create(array $details)
    {
        return TeacherAttendance::create($details);
    }

    public function show($id)
    {
        return TeacherAttendance::with(['teacher', 'approvedBy'])->findOrFail($id);
    }

    public function update($id, array $details)
    {
        $attendance = TeacherAttendance::findOrFail($id);
        $attendance->update($details);
        return $attendance;
    }

    public function delete($id)
    {
        $attendance = TeacherAttendance::findOrFail($id);
        $attendance->delete();
        return true;
    }

    public function findById($id)
    {
        return TeacherAttendance::with(['teacher', 'approvedBy'])->find($id);
    }

    public function getByTeacherId($teacherId)
    {
        return TeacherAttendance::byTeacher($teacherId)
                               ->with(['teacher', 'approvedBy'])
                               ->latest('date')
                               ->get();
    }

    public function getByTeacherIdAndDate($teacherId, $date)
    {
        return TeacherAttendance::byTeacher($teacherId)
                               ->byDate($date)
                               ->first();
    }

    public function getByTeacherIdAndDateRange($teacherId, $startDate, $endDate)
    {
        return TeacherAttendance::byTeacher($teacherId)
                               ->byDateRange($startDate, $endDate)
                               ->with(['teacher', 'approvedBy'])
                               ->latest('date')
                               ->get();
    }

    public function getByDate($date)
    {
        return TeacherAttendance::byDate($date)
                               ->with(['teacher', 'approvedBy'])
                               ->get();
    }

    public function getByDateRange($startDate, $endDate)
    {
        return TeacherAttendance::byDateRange($startDate, $endDate)
                               ->with(['teacher', 'approvedBy'])
                               ->latest('date')
                               ->get();
    }

    public function getByStatus($status)
    {
        return TeacherAttendance::byStatus($status)
                               ->with(['teacher', 'approvedBy'])
                               ->latest('date')
                               ->get();
    }

    public function getPendingApprovals($limit = 50)
    {
        return TeacherAttendance::pending()
                               ->with(['teacher', 'approvedBy'])
                               ->latest('date')
                               ->limit($limit)
                               ->get();
    }

    public function getApproved()
    {
        return TeacherAttendance::approved()
                               ->with(['teacher', 'approvedBy'])
                               ->latest('date')
                               ->get();
    }

    public function getRejected()
    {
        return TeacherAttendance::rejected()
                               ->with(['teacher', 'approvedBy'])
                               ->latest('date')
                               ->get();
    }

    public function getPresentCount($teacherId, $startDate, $endDate)
    {
        return TeacherAttendance::byTeacher($teacherId)
                               ->byDateRange($startDate, $endDate)
                               ->present()
                               ->count();
    }

    public function getAbsentCount($teacherId, $startDate, $endDate)
    {
        return TeacherAttendance::byTeacher($teacherId)
                               ->byDateRange($startDate, $endDate)
                               ->absent()
                               ->count();
    }

    public function getLeaveCount($teacherId, $startDate, $endDate)
    {
        return TeacherAttendance::byTeacher($teacherId)
                               ->byDateRange($startDate, $endDate)
                               ->onLeave()
                               ->count();
    }

    public function getTotalHours($teacherId, $startDate, $endDate)
    {
        return TeacherAttendance::byTeacher($teacherId)
                               ->byDateRange($startDate, $endDate)
                               ->sum('duration_minutes') / 60;
    }

    public function getAttendanceForCurrentMonth($teacherId)
    {
        return $this->getByTeacherIdAndDateRange(
            $teacherId,
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        );
    }

    public function hasConflict($teacherId, $date)
    {
        return TeacherAttendance::byTeacher($teacherId)
                               ->byDate($date)
                               ->exists();
    }
}
