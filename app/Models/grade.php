<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\Section;

class grade extends Model
{
    protected $fillable = [
        'name',
        'description',
    ] ;

    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(subject::class, 'grade_subject');
    }
}
