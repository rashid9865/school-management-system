<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    public $timestamp = false;
    protected $guarded = [];

    public function teachers()
    {
        return $this->belongsToMany(teacher::class,
            'assign_subject_to_teacher',
            'subject_id',
            'teacher_id'
        );
    }

    public function students()
    {
        return $this->belongsToMany(student::class, 'student_subject');
    }

    public function grades()
    {
        return $this->belongsToMany(grade::class, 'grade_subject');
    }

    public function timetables()
    {
        return $this->belongsToMany(timetable::class);
    }
}
