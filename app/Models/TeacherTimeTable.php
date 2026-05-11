<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;
class TeacherTimeTable extends Model
{
     public function teachers()
     {
          return $this->hasMany(Teacher::class);
     }        
}
