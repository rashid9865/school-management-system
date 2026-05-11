<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Message extends Model
{
    protected $fillable = [
        'student_id',
        'sender',
        'type',
        'content',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
