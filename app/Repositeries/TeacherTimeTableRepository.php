<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\TeacherTimeTable;

class TeacherTimeTableRepository implements CommonInterface
{
    public function getAll()
    {
        return TeacherTimeTable::all();
    }

    public function create(array $details)
    {
        return TeacherTimeTable::create($details);
    }

    public function show($id)
    {
        return TeacherTimeTable::findOrFail($id);
    }

    public function update($id, array $details)
    {
        $timetable = TeacherTimeTable::findOrFail($id);
        $timetable->update($details);
        return $timetable;
    }

    public function delete($id)
    {
        $timetable = TeacherTimeTable::findOrFail($id);
        $timetable->delete();
        return true;
    }

    public function findById($id)
    {
        return TeacherTimeTable::find($id);
    }

    public function getByTeacherId($teacherId)
    {
        return TeacherTimeTable::where('teacher_id', $teacherId)->get();
    }
}
