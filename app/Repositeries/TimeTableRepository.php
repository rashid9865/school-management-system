<?php
namespace App\Repositeries;
use App\Interfaces\CommonInterface;
use App\Models\TimeTable;

class TimeTableRepository implements CommonInterface
{
    public function getAll()
    {
         return TimeTable::all();
    }

    public function getByGradeId($gradeId)
    {
        return TimeTable::where('grade_id', $gradeId)->get();
    }

    public function create(array $details)
    {
       return  TimeTable::create($details);     
    }
    
    public function show($id)
    {
        return TimeTable::findOrFail($id);
    }

    public function update($id, array $details)
    {
        $timeTable = TimeTable::findOrFail($id);
        $timeTable->update($details);
        return $timeTable;
    }

    public function delete($id)
    {
        $timeTable = TimeTable::findOrFail($id);
        $timeTable->delete();
    }

    public function findById($id)
    {
        return TimeTable::findOrFail($id);
    }
}

?>