<aside>
    <div class="sidebar">
        <h2>Student Panel</h2>
        <ul>
            <li><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('student.profile') }}">My Profile</a></li>
            <li><a href="{{ route('student.attendance') }}">Attendance</a></li>
            <li><a href="{{ route('student.subjects') }}">Subjects</a></li>
            <li><a href="{{ route('student.assignments') }}">Assignments</a></li>
            <li><a href="{{ route('student.timetable') }}">Timetable</a></li>
            <li><a href="{{ route('student.results') }}">Results</a></li>
            <li><a href="{{ route('student.fees') }}">Fee Details</a></li>
            <li><a href="{{ route('student.announcements') }}">Announcements</a></li>
            <li><a href="{{ route('student.messages') }}">Messages</a></li>
            <li><a href="{{ route('student.register') }}">Register Student</a></li>
            {{-- <li><a href="{{ route('user.logout') }}">Logout</a></li> --}}
        </ul>
    </div>
</aside>