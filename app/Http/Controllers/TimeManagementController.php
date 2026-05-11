<?php

namespace App\Http\Controllers;

use App\Models\TimeManagement;
use Illuminate\Http\Request;
use App\Repositeries\TimeManagementRepo;

class TimeManagementController extends Controller
{
    private $timeManagementRepo;

    public function __construct(TimeManagementRepo $timeManagementRepo)
    {
        $this->timeManagementRepo = $timeManagementRepo;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timeManagement = $this->timeManagementRepo->getAll();
        return view('users.admin.time_management', compact('timeManagement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $timeManagement = $this->timeManagementRepo->getAll();
        return view('users.admin.create_time_management', compact('timeManagement'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'day' => 'required|string|max:255',
            'date' => 'nullable|date',
            'period_minutes' => 'required|integer|min:1',
        ]);

        $timeManagement = $this->timeManagementRepo->create($request->all());
        return redirect()->route('time-management.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(TimeManagement $timeManagement)
    {
        return $this->timeManagementRepo->show($timeManagement->id);    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeManagement $timeManagement)
    {   $timeManagements = $this->timeManagementRepo->findById($timeManagement->id);
        return view('users.admin.edit_time_management', compact('timeManagements'));
    }

    /**
     * Update the specified resource in storage.s
     */
    public function update(Request $request, TimeManagement $timeManagement)
    {
        $request->validate([
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'day' => 'required|string|max:255',
            'date' => 'nullable|date',
            'period_minutes' => 'required|integer|min:1',
        ]);

        $updatedTimeManagement = $this->timeManagementRepo->update($timeManagement->id, $request->all());
        return redirect()->route('time-management.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeManagement $timeManagement)
    {
        $this->timeManagementRepo->delete($timeManagement->id);
        return redirect()->route('time-management.index');
    }
}
