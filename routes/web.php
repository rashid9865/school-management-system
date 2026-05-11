<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TimeTableController;
use App\Http\Controllers\TimeManagementController;
use App\Http\Controllers\FeeStructureController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AssignmentController;

// ============================================
// PUBLIC ROUTES
// ============================================
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/help', [PublicController::class, 'help'])->name('help');

Route::get('/', function () {
    return redirect()->route('user.login');
})->name('login');
// ============================================
// AUTHENTICATION ROUTES
// ============================================
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'storeUser'])->name('store');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginUser'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ============================================
// ADMIN ROUTES
// ============================================
Route::prefix('admin')
    ->middleware('auth')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // Profile Management
        Route::get('/profile/edit', [ProfileController::class, 'editProfile'])
            ->name('profile.edit');
        Route::put('/profile/edit', [ProfileController::class, 'updateProfile'])
            ->name('profile.update');
        Route::get('/profile-info/{id}', [ProfileController::class, 'show'])
            ->name('profile.info');

        // User Management - Roles & Permissions
        Route::get('/users', [UserManagementController::class, 'admins'])
            ->name('users.index');
        Route::get('/roles', [UserManagementController::class, 'roles'])
            ->name('roles.index');
        Route::put('/users/{user}/role', [UserManagementController::class, 'updateUserRole'])
            ->name('users.role.update');
        Route::get('/permissions', [UserManagementController::class, 'permissions'])
            ->name('permissions.index');

        // Settings
        Route::get('/settings', [SettingsController::class, 'index'])
            ->name('settings.index');
        Route::post('/settings', [SettingsController::class, 'update'])
            ->name('settings.update');

        // Attendance
        Route::get('/attendance/mark', [AttendanceController::class, 'mark'])
            ->name('attendance.mark');
        Route::post('/attendance/store', [AttendanceController::class, 'store'])
            ->name('attendance.store');

        // Teacher Attendance Approvals
        Route::get('/teacher-attendance/approvals', [TeacherController::class, 'pendingApprovals'])
            ->name('teacher-attendance.approvals');
        Route::post('/teacher-attendance/{id}/approve', [TeacherController::class, 'approveAttendance'])
            ->name('teacher-attendance.approve');

        // Exams
        Route::get('/exams/create', [ExamController::class, 'create'])
            ->name('exams.create');
        Route::post('/exams/store', [ExamController::class, 'store'])
            ->name('exams.store');

    });


// ============================================
// TEACHER ROUTES
// ============================================
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherController::class, 'dashboard'])->name('dashboard');
    Route::get('/register', [TeacherController::class, 'register'])->name('register');
    Route::post('/register', [TeacherController::class, 'store'])->name('store');
    Route::get('/login', [TeacherController::class, 'login'])->name('login');
    Route::post('/login', [TeacherController::class, 'loginTeacher'])->name('login');
    
    Route::get('/allTeachers', [TeacherController::class, 'allTeachers'])->name('allTeachers');
    Route::get('/layout', [TeacherController::class, 'layout'])->name('layout');
    Route::get('/classes', [TeacherController::class, 'classes'])->name('classes');
    Route::get('/students', [TeacherController::class, 'seeStudent'])->name('students');
    Route::get('/profile', [TeacherController::class, 'profile'])->name('profile');
    
    // Attendance
    Route::get('/attendance', [TeacherController::class, 'attendence'])->name('attendance');
    Route::post('/attendance', [TeacherController::class, 'storeAttendance'])->name('attendance.store');
    Route::get('/self-attendance', [TeacherController::class, 'selfAttendance'])->name('self.attendance');
    Route::post('/self-attendance', [TeacherController::class, 'storeSelfAttendance'])->name('self.attendance.store');
    Route::get('/attendance-history', [TeacherController::class, 'attendanceHistory'])->name('attendance.history');
    Route::post('/attendance/{id}/approve', [TeacherController::class, 'approveAttendance'])->name('attendance.approve');
    
    // Subjects & Assignments
    Route::get('/subjects', [TeacherController::class, 'subject'])->name('subjects');
    Route::get('/assignments', [TeacherController::class, 'assignment'])->name('assignments');
    Route::post('/assignments', [TeacherController::class, 'storeAssignment'])->name('assignments.store');
    
    // Exams & Marks
    Route::get('/exams', [TeacherController::class, 'exam'])->name('exams');
    Route::get('/marks', [TeacherController::class, 'marks'])->name('marks');
    
    // Resources
    Route::get('/study-material', [TeacherController::class, 'studymeterial'])->name('study-material');
    Route::get('/timetable', [TeacherController::class, 'timetable'])->name('timetable');
    Route::get('/announcements', [TeacherController::class, 'announce'])->name('announcements');
    Route::get('/messages', [TeacherController::class, 'message'])->name('messages');
    
    // CRUD Operations
    Route::get('/{id}', [TeacherController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('edit');
    Route::put('/{id}', [TeacherController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TeacherController::class, 'deleteTeacher'])->name('destroy');
});


// ============================================
// STUDENT ROUTES
// ============================================
Route::prefix('student')->name('student.')->group(function () {
    Route::get('/register', [StudentController::class, 'register'])->name('register');
    Route::post('/register', [StudentController::class, 'store'])->name('store');
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::get('/layout', [StudentController::class, 'layout'])->name('layout');
    
    Route::get('/students', [StudentController::class, 'allStudents'])->name('allstudents');
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    
    // Academic
    Route::get('/attendance', [StudentController::class, 'attendence'])->name('attendance');
    Route::get('/subjects', [StudentController::class, 'subject'])->name('subjects');
    Route::get('/assignments', [StudentController::class, 'assignment'])->name('assignments');
    Route::get('/timetable', [StudentController::class, 'timetable'])->name('timetable');
    Route::get('/results', [StudentController::class, 'result'])->name('results');
    
    // Finance & Communication
    Route::get('/fees', [StudentController::class, 'fees'])->name('fees');
    Route::get('/announcements', [StudentController::class, 'announce'])->name('announcements');
    Route::get('/messages', [StudentController::class, 'message'])->name('messages');
    
    // CRUD Operations
    Route::get('/{id}', [StudentController::class, 'showStudent'])->name('show');
    Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('edit');
    Route::put('/students/{id}', [StudentController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [StudentController::class, 'destroy'])->name('destroy');
});

// ============================================
// AJAX API ROUTES
// ============================================
Route::post('/api/teacher/delete/{id}', [TeacherController::class, 'ajaxDestroy'])->name('teacher.ajax.destroy');
Route::post('/api/student/delete/{id}', [StudentController::class, 'ajaxDestroy'])->name('student.ajax.destroy');

// ============================================
// RESOURCE ROUTES
// ============================================

// Subjects
Route::resource('/subjects', SubjectController::class);
Route::post('/assign/subject/', [SubjectController::class, 'assignSubject'])->name('assign.subject');
Route::post('/subjects/toggle-status', [SubjectController::class, 'toggleStatus'])->name('subject.toggle');
Route::get('/search/subjects', [SubjectController::class, 'search'])->name('subjects.search');
Route::get('/search/results', [SubjectController::class, 'searchResults'])->name('search.results');

// Grades
Route::resource('/grades', GradeController::class);
Route::get('/assign/student', [GradeController::class, 'assignStudent'])->name('assignStudent');
Route::post('/student/assigned', [GradeController::class, 'studentAssigned'])->name('studentAssigned');
Route::get('/assign/subjects', [GradeController::class, 'assignSubjects'])->name('assignSubjects');
Route::post('/assign/subjects', [GradeController::class, 'storeSubjectAssignment'])->name('storeSubjectAssignment');
Route::delete('/remove/subject-assignment/{gradeId}/{subjectId}', [GradeController::class, 'removeSubjectAssignment'])->name('removeSubjectAssignment');

// Sections
Route::resource('sections', SectionController::class);

// Assignments
Route::resource('assignments', AssignmentController::class);

// Time Management
Route::resource('/time-management', TimeManagementController::class);

// Timetables
Route::get('/createStudentTimeTable', [TimeTableController::class, 'create'])->name('createStudentTimetable');
Route::post('/createStudentTimeTable', [TimeTableController::class, 'store'])->name('timetable');
Route::get('/editStudentTimeTable/{id}', [TimeTableController::class, 'edit'])->name('editStudentTimetable');
Route::put('/updateStudentTimeTable/{id}', [TimeTableController::class, 'update'])->name('updateStudentTimetable');
Route::get('/admin/timetables', [TimeTableController::class, 'index'])->name('admin.timetables.index');
Route::get('/api/subjects-by-grade/{gradeId}', [TimeTableController::class, 'getSubjectsByGrade'])->name('api.subjects.by.grade');
Route::get('/api/available-times', [TimeTableController::class, 'getAvailableTimes'])->name('api.available.times');
Route::get('/api/available-subjects', [TimeTableController::class, 'getAvailableSubjects'])->name('api.available.subjects');
Route::delete('/admin/timetables/{id}', [TimeTableController::class, 'destroy'])->name('admin.timetables.destroy');

// ============================================
// FEE MANAGEMENT ROUTES
// ============================================
Route::prefix('fee')->name('fee.')->group(function () {
    Route::get('/fee-structures', [FeeStructureController::class, 'index'])->name('fee-structures.index');
    Route::post('/fee-structures', [FeeStructureController::class, 'store'])->name('fee-structures.store');
    Route::get('/collect', [FeeStructureController::class, 'collectFee'])->name('collect');
    Route::post('/{fee}/collect', [FeeStructureController::class, 'collectFeeStore'])->name('collect.store');
    Route::get('/pending', [FeeStructureController::class, 'pendingFees'])->name('pending');
});

// ============================================
// REPORT ROUTES
// ============================================
Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/students', [ReportController::class, 'studentReports'])->name('students');
    Route::get('/attendance', [ReportController::class, 'attendanceReports'])->name('attendance');
    Route::get('/fees', [ReportController::class, 'feeReports'])->name('fees');
});



