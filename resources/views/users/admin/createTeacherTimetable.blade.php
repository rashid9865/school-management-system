@extends('users.admin.layout');

@section('title')
      Create timetable
@endsection

@section('content')

    <form action="">
        <label>Subject name</label>
        <input type= "text" name = "name" placeholder="Enter subject name">
        
        <label>Select Day:</label>
        <section name= "day" id="day">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wedensday">Wedensday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>

        </section>
        <input type="" name = "day" placeholder="Enter day">

        <label>Time</label>
        <input name = "time" 
    </form>

@endsection
