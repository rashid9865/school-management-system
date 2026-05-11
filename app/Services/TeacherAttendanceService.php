<?php

namespace App\Services;

use App\Repositeries\TeacherAttendanceRepository;
use Carbon\Carbon;
use DB;

class TeacherAttendanceService
{
    protected $repository;

    public function __construct(TeacherAttendanceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Record attendance for a teacher
     */
    public function recordAttendance(array $data)
    {
        return DB::transaction(function () use ($data) {
            $attendance = $this->repository->create($data);
            
            // Calculate duration if both times are provided
            if (isset($data['time_in']) && isset($data['time_out'])) {
                $attendance->calculateDuration();
            }
            
            return $attendance;
        });
    }

    /**
     * Get teacher attendance for a date range
     */
    public function getAttendanceByDateRange($teacherId, $startDate, $endDate)
    {
        return $this->repository->getByTeacherIdAndDateRange(
            $teacherId,
            $startDate,
            $endDate
        );
    }

    /**
     * Get pending approvals
     */
    public function getPendingApprovals($limit = 50)
    {
        return $this->repository->getPendingApprovals($limit);
    }

    /**
     * Approve attendance
     */
    public function approveAttendance($attendanceId, $approvedByUserId, $remarks = null)
    {
        return DB::transaction(function () use ($attendanceId, $approvedByUserId, $remarks) {
            return $this->repository->update($attendanceId, [
                'approval_status' => 'approved',
                'approved_by' => $approvedByUserId,
                'remarks' => $remarks
            ]);
        });
    }

    /**
     * Reject attendance
     */
    public function rejectAttendance($attendanceId, $approvedByUserId, $remarks)
    {
        return DB::transaction(function () use ($attendanceId, $approvedByUserId, $remarks) {
            return $this->repository->update($attendanceId, [
                'approval_status' => 'rejected',
                'approved_by' => $approvedByUserId,
                'remarks' => $remarks
            ]);
        });
    }

    /**
     * Get attendance statistics for a teacher
     */
    public function getAttendanceStats($teacherId, $startDate, $endDate)
    {
        $attendances = $this->repository->getByTeacherIdAndDateRange($teacherId, $startDate, $endDate);
        
        return [
            'total_days' => $attendances->count(),
            'present' => $attendances->where('status', 'present')->count(),
            'absent' => $attendances->where('status', 'absent')->count(),
            'leave' => $attendances->where('status', 'leave')->count(),
            'pending_approval' => $attendances->where('approval_status', 'pending')->count(),
            'approved' => $attendances->where('approval_status', 'approved')->count(),
            'rejected' => $attendances->where('approval_status', 'rejected')->count(),
            'attendance_percentage' => $this->calculateAttendancePercentage($attendances),
            'total_hours' => $this->calculateTotalHours($attendances),
        ];
    }

    /**
     * Calculate attendance percentage
     */
    private function calculateAttendancePercentage($attendances)
    {
        if ($attendances->count() === 0) {
            return 0;
        }

        $presentDays = $attendances->where('status', 'present')->count();
        $totalDays = $attendances->where('status', '!=', 'leave')->count();

        if ($totalDays === 0) {
            return 0;
        }

        return round(($presentDays / $totalDays) * 100, 2);
    }

    /**
     * Calculate total working hours
     */
    private function calculateTotalHours($attendances)
    {
        $totalMinutes = $attendances->sum('duration_minutes') ?? 0;
        return round($totalMinutes / 60, 2);
    }

    /**
     * Check if teacher already marked attendance for a date
     */
    public function hasAttendanceForDate($teacherId, $date)
    {
        return $this->repository->getByTeacherIdAndDate($teacherId, $date) !== null;
    }

    /**
     * Get today's status for a teacher
     */
    public function getTodayStatus($teacherId)
    {
        return $this->repository->getByTeacherIdAndDate($teacherId, Carbon::today());
    }
}
