<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;

class section extends Model
{
    protected $guarded = [];
    public function students()
    {
         return $this->hasMany(Student::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
