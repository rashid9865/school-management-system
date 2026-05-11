<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\Assignment;

class AssignmentRepositry implements CommonInterface
{
    public function getAll()
    {
        return Assignment::all();
    }

    public function create(array $details)
    {
        return Assignment::create($details);
    }

    public function show($id)
    {
        return Assignment::with(['teacher', 'students'])->findOrFail($id);
    }

    public function update($id, array $details)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->update($details);
        return $assignment;
    }

    public function delete($id)
    {
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();
        return true;
    }

    public function findById($id)
    {
        return Assignment::find($id);
    }

    public function getByTeacherId($teacherId)
    {
        return Assignment::with(['teacher', 'students'])
            ->where('teacher_id', $teacherId)
            ->get();
    }

    public function countByTeacherId($teacherId)
    {
        return Assignment::where('teacher_id', $teacherId)->count();
    }
}
