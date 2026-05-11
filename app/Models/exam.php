<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ap\Models\Student;
class exam extends Model
{
    protected $gaurded = [];
    
    public function students()
    {
        return $this->belongsToMany(Student::class,'student_exam');
    }
}
