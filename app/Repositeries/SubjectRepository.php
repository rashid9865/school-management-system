<?php

namespace App\Repositeries;
use App\Models\Subject;
use App\Interfaces\CommonInterface;

class SubjectRepository implements CommonInterface
{
    /**
     * Create a new class instance.
     */

    public function __construct()
    {
        //
    }

    public function getAll()
    {
        return Subject::all();
    }
    public function findById($id)
    {
        return Subject::find($id);
    }
    public function create(array $data)
    {      
        return Subject::create($data);
    }
    public function update($id, array $data)
    {
        $subject = $this->findById($id);
        $subject->update($data);
        return $subject;
    }
    public function delete($id)
    {
        $subject = $this->findById($id);
        $subject->delete();
    }
    public function show($id)
    {
        return $this->findById($id);
    }

}
