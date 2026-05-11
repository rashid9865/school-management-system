<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\FeeStructure;

class FeeStructureRepository implements CommonInterface
{
    public function getAll()
    {
        return FeeStructure::with(['grade', 'section'])->get();
    }

    public function create(array $details)
    {
        return FeeStructure::create($details);
    }

    public function show($id)
    {
        return FeeStructure::with(['grade', 'section'])->findOrFail($id);
    }

    public function update($id, array $details)
    {
        $feeStructure = FeeStructure::findOrFail($id);
        $feeStructure->update($details);
        return $feeStructure;
    }

    public function delete($id)
    {
        $feeStructure = FeeStructure::findOrFail($id);
        $feeStructure->delete();
        return true;
    }

    public function findById($id)
    {
        return FeeStructure::find($id);
    }
}
