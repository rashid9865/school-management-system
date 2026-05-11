<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
class attendend extends Model
{
    protected $guarded = [];

    protected $casts = [
        'date' => 'datetime:Y-m-d',
    ];
    
    public function student()
    {
    	return $this->belongsTo(Student::class);
    }
}
