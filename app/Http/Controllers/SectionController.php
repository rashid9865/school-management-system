<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositeries\SectionRepository;
use App\Repositeries\GradeRepository;

class SectionController extends Controller
{
    protected $sectionRepository;
    protected $gradeRepository;

    public function __construct(SectionRepository $sectionRepository, GradeRepository $gradeRepository)
    {
        $this->sectionRepository = $sectionRepository;
        $this->gradeRepository = $gradeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = $this->sectionRepository->getAll();
        $grades = $this->gradeRepository->getAll();
        return view('sections.index', compact('sections', 'grades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grades = $this->gradeRepository->getAll();
        return view('sections.create', compact('grades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'grade_id' => 'required|exists:grades,id',
        ]);

        $this->sectionRepository->create($request->only(['name', 'grade_id']));

        return redirect()->route('sections.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
