<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-mark"></div>
        <div>
            <p class="brand-label">School Admin</p>
            <h2>Control Panel</h2>
        </div>
    </div>

    <nav class="sidebar-nav">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link">
            Dashboard
        </a>

        {{-- Students Management --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Students Management
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('student.allstudents') }}">
                        All Students
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.register') }}">
                        Add Student
                    </a>
                </li>
            </ul>
        </div>

        {{-- Teacher Management --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Teacher Management
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('teacher.allTeachers') }}">
                        All Teachers
                    </a>
                </li>

                <li>
                    <a href="{{ route('teacher.register') }}">
                        Add Teacher
                    </a>
                </li>
            </ul>
        </div>

        {{-- Courses --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Courses
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('subjects.index') }}">
                        All Subjects
                    </a>
                </li>

                <li>
                    <a href="{{ route('subjects.create') }}">
                        Add Subjects
                    </a>
                </li>

                <li>
                    <a href="{{ route('assignSubjects') }}">
                        Assign To Class
                    </a>
                </li>

                {{-- These routes need to be added to a Subject Assignment Controller --}}
                {{-- <li>
                    <a href="{{ route('admin.assign-subject') }}">
                        Assign To Teacher
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.assigned-subjects') }}">
                        Assigned Subjects
                    </a>
                </li> --}}
            </ul>
        </div>

        {{-- Classes --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Classes
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('grades.index') }}">
                        Show All Classes
                    </a>
                </li>

                <li>
                    <a href="{{ route('sections.index') }}">
                        Sections
                    </a>
                </li>

                <li>
                    <a href="{{ route('assignStudent') }}">
                        Assign Students
                    </a>
                </li>

                <li>
                    <a href="{{ route('assignSubjects') }}">
                        Assign Subjects To Classes
                    </a>
                </li>
            </ul>
        </div>

        {{-- Timetable --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Timetable
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('time-management.index') }}">
                        View Time Slots
                    </a>
                </li>

                <li>
                    <a href="{{ route('time-management.create') }}">
                        Create Time Slot
                    </a>
                </li>

                <li>
                    <a href="{{ route('createStudentTimetable') }}">
                        Create Student Timetable
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.timetables.index') }}">
                        View Student Timetable
                    </a>
                </li>
            </ul>
        </div>

        {{-- Attendance --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Attendance
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('reports.attendance') }}">
                        View Attendance
                    </a>
                </li>
            </ul>
        </div>

        {{-- Fee Management --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Fee Management
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('fee.fee-structures.index') }}">
                        Fee Structure
                    </a>
                </li>

                <li>
                    <a href="{{ route('fee.collect') }}">
                        Collect Fee
                    </a>
                </li>

                <li>
                    <a href="{{ route('fee.pending') }}">
                        Pending Fees
                    </a>
                </li>
            </ul>
        </div>

        {{-- Reports --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Reports
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('reports.students') }}">
                        Student Reports
                    </a>
                </li>

                <li>
                    <a href="{{ route('reports.attendance') }}">
                        Attendance Reports
                    </a>
                </li>

                <li>
                    <a href="{{ route('reports.fees') }}">
                        Fee Reports
                    </a>
                </li>
            </ul>
        </div>

        {{-- Users & Roles --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Users & Roles
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        Admins
                    </a>
                </li>

                <li>
                    <a href="{{ route('admin.permissions.index') }}">
                        Permissions
                    </a>
                </li>
            </ul>
        </div>

        {{-- Admin Management --}}
        <div class="sidebar-group">
            <a href="#" class="menu-link">
                Admin Management
                <span class="arrow">▾</span>
            </a>

            <ul class="submenu">
                <li>
                    <a href="{{ route('user.register') }}">
                        Register Admin
                    </a>
                </li>
            </ul>
        </div>

        {{-- Logout --}}
        {{-- 
        <a href="{{ route('user.logout') }}" class="sidebar-link sidebar-link-logout">
            Logout
        </a> 
        --}}

    </nav>
</aside>