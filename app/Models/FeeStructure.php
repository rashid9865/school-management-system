<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $guarded = [];

    public function grade()
    {
        return $this->belongsTo(grade::class);
    }

    public function section()
    {
        return $this->belongsTo(section::class);
    }

    public function fees()
    {
        return $this->hasMany(fees::class);
    }
}
