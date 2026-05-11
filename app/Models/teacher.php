<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class teacher extends Authenticatable
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(subject::class,
        'assign_subject_to_teacher',
        'teacher_id',
        'subject_id'
        );
    }

    public function students()
    {
        return $this->belongsToMany(student::class, 'student_teacher');
    }
    
}
