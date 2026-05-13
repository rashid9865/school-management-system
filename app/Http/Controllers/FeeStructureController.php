<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeStructure;
use App\Repositeries\FeesRepository;
use App\Repositeries\GradeRepository;
use App\Repositeries\SectionRepository;


class FeeStructureController extends Controller
{
    protected $feesRepository;
    protected $gradeRepository;
    protected $sectionRepository;

    public function __construct(FeesRepository $feesRepository, GradeRepository $gradeRepository, SectionRepository $sectionRepository)
    {
        $this->feesRepository = $feesRepository;
        $this->gradeRepository = $gradeRepository;
        $this->sectionRepository = $sectionRepository;
    }

    public function index()
    {
        $feeStructures = $this->feesRepository->getAll();
        $grades = $this->gradeRepository->getAll();
        $sections = $this->sectionRepository->getAll();

        return view('users.admin.fee_structures.index', compact('feeStructures', 'grades', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'nullable|exists:grades,id',
            'section_id' => 'nullable|exists:sections,id',
            'semester' => 'nullable|string|max:255',
            'type' => 'required|in:class,section,semester,class_semester',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
        ]);

        FeeStructure::create($request->only(['grade_id', 'section_id', 'semester', 'type', 'amount', 'description']));

        return redirect()->route('admin.fee-structures.index')->with('success', 'Fee structure saved successfully.');
    }

     public function collectFee()
    {
        $pendingFees = $this->feesRepository->getPendingFees();
        return view('users.admin.collect_fee', compact('pendingFees'));
    }

    public function collectFeeStore($id)
    {
        $this->feesRepository->update($id, ['status' => 'paid']);
        return redirect()->route('admin.fees.collect')->with('success', 'Fee collected successfully.');
    }

    public function pendingFees()
    {
        $pendingFees = $this->feesRepository->getPendingFees();
        return view('users.admin.pending_fees', compact('pendingFees'));
    }

}
