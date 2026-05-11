<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\fees;

class student extends Authenticatable
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fees()
    {
        return $this->hasMany(fees::class);
    }
    
    public function grade()
    {
            return $this->belongsTo(grade::class);
    }

    public function section()
    {
            return $this->belongsTo(section::class);
    }
            
    public function subjects()
    {
        return $this->belongsToMany(subject::class, 'student_subject');
    }

    public function assignments()
    {
        return $this->belongsToMany(Assignment::class, 'student_assignment');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function attendances()
    {
        return $this->hasMany(attendend::class);
    }
    
}
