<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\Exam;

class ExamRepositry implements CommonInterface
{
    public function getAll()
    {
        return Exam::all();
    }

    public function create(array $details)
    {
        return Exam::create($details);
    }

    public function show($id)
    {
        return Exam::findOrFail($id);
    }

    public function update($id, array $details)
    {
        $exam = Exam::findOrFail($id);
        $exam->update($details);
        return $exam;
    }

    public function delete($id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return true;
    }

    public function findById($id)
    {
        return Exam::find($id);
    }

    public function countAll()
    {
        return Exam::count();
    }
}
