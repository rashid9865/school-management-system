<?php

namespace App\Repositeries;

use App\Models\TimeManagement;
use App\Interfaces\CommonInterface;

class TimeManagementRepo implements CommonInterface
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
        return TimeManagement::all();
    }

    public function create(array $details)
    {
        return TimeManagement::create($details);
    }
    
    public function show($id)
    {
        return TimeManagement::findOrFail($id);
    }

    public function update($id, array $details)
    {
        $timeManagement = TimeManagement::findOrFail($id);
        $timeManagement->update($details);
        return $timeManagement;
    }

    public function delete($id)
    {
        $timeManagement = TimeManagement::findOrFail($id);
        $timeManagement->delete();
    }

    public function findById($id)
    {
        return TimeManagement::findOrFail($id);
    }   
}
