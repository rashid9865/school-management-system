<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\Mark;

class MarkRepositry implements CommonInterface
{
    public function getAll()
    {
        return Mark::with(['student', 'subjects'])->get();
    }

    public function create(array $details)
    {
        return Mark::create($details);
    }

    public function show($id)
    {
        return Mark::with(['student', 'subjects'])->findOrFail($id);
    }

    public function update($id, array $details)
    {
        $mark = Mark::findOrFail($id);
        $mark->update($details);
        return $mark;
    }

    public function delete($id)
    {
        $mark = Mark::findOrFail($id);
        $mark->delete();
        return true;
    }

    public function findById($id)
    {
        return Mark::find($id);
    }

    public function getByStudentIds(array $studentIds)
    {
        return Mark::with(['student', 'subjects'])
            ->whereIn('student_id', $studentIds)
            ->get();
    }
}
