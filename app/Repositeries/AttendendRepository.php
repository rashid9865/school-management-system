<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\Attendend;

class AttendendRepository implements CommonInterface
{
    public function getAll()
    {
        return Attendend::with('student')->get();
    }

    public function create(array $details)
    {
        return Attendend::create($details);
    }

    public function show($id)
    {
        return Attendend::with('student')->findOrFail($id);
    }

    public function update($id, array $details)
    {
        $attendance = Attendend::findOrFail($id);
        $attendance->update($details);
        return $attendance;
    }

    public function delete($id)
    {
        $attendance = Attendend::findOrFail($id);
        $attendance->delete();
        return true;
    }

    public function findById($id)
    {
        return Attendend::find($id);
    }

    public function getByStudentIds(array $studentIds)
    {
        return Attendend::with('student')
            ->whereIn('student_id', $studentIds)
            ->get();
    }
}
