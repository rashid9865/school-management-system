<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;
class TimeTable extends Model
{
    protected $guarded = [];
    public function students()
    
    {
        return $this->hasMany(Grade::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(subject::class);
    }
    
   
}
