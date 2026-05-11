<?php

namespace App\Repositeries;

use App\Interfaces\CommonInterface;
use App\Models\Fees;

class FeesRepository implements CommonInterface
{
    public function getAll()
    {
        return Fees::all();
    }

    public function getPendingFees()
    {
        return Fees::with(['student.user'])->where('status', 'unpaid')->get();
    }

    public function getOrderedByDueDate()
    {
        return Fees::with(['student.user', 'feeStructure'])->orderBy('due_date', 'desc')->get();
    }

    public function create(array $details)
    {
        return Fees::create($details);
    }

    public function show($id)
    {
        return Fees::with(['student.user', 'feeStructure'])->findOrFail($id);
    }

    public function update($id, array $details)
    {
        $fee = Fees::findOrFail($id);
        $fee->update($details);
        return $fee;
    }

    public function delete($id)
    {
        $fee = Fees::findOrFail($id);
        $fee->delete();
        return true;
    }

    public function findById($id)
    {
        return Fees::find($id);
    }
}
