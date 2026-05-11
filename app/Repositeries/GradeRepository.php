<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\Grade;

class GradeRepository implements CommonInterface
{
    public function getAll()
    {
        return Grade::all();
    }

    public function create(array $details)
    {
        return Grade::create($details);
    }
    
    public function show($id)
    {
        return Grade::find($id);
    }

    public function update($id, array $details)
    {
        $grade = Grade::find($id);
        if ($grade) {
            return $grade->update($details);
        }
        return false;
    }

    public function delete($id)
    {
        $grade = Grade::find($id);
        if ($grade) {
            $grade->delete();
        }
    }

    public function findById($id)
    {
        return Grade::find($id);
    }

}