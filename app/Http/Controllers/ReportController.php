<?php

namespace App\Http\Controllers;

use App\Repositeries\StudentRepositry;
use App\Repositeries\AttendendRepository;
use App\Repositeries\FeesRepository;

class ReportController extends Controller
{
    protected $studentRepository;
    protected $attendanceRepository;
    protected $feesRepository;

    public function __construct(
        StudentRepositry $studentRepository,
        AttendendRepository $attendanceRepository,
        FeesRepository $feesRepository
    )
    {
        $this->studentRepository = $studentRepository;
        $this->attendanceRepository = $attendanceRepository;
        $this->feesRepository = $feesRepository;
    }

    public function studentReports()
    {
        $students = $this->studentRepository->getAll();

        return view('users.admin.reports.student_reports', compact('students'));
    }

    public function attendanceReports()
    {
        $attendance = $this->attendanceRepository->getAll();

        return view('users.admin.reports.attendance_reports', compact('attendance'));
    }

    public function feeReports()
    {
        $fees = $this->feesRepository->getOrderedByDueDate();

        return view('users.admin.reports.fee_reports', compact('fees'));
    }
}