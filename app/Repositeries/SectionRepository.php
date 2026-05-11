<?php

namespace App\Repositeries;
use App\Interfaces\CommonInterface;
use App\Models\Section;

class SectionRepository implements CommonInterface
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
        return Section::all();
     }

    public function create(array $details)
    {
        return Section::create($details);
    }

    
    
    public function show($id)
    {
        return Section::find($id);
    }

    public function update($id, array $details)
    {
        $section = Section::find($id);
        $section->update($details);
        return $section;
    }

    

    public function delete($id) 
    {
        $section = Section::find($id);
        if ($section) {
            $section->delete();
        }
    }

    public function findById($id)
    {
        return Section::find($id);
    }
}

