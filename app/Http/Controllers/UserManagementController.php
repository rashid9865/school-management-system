<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositeries\UserRepository;

class UserManagementController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function admins()
    {
        $admins = $this->userRepository->getAll();
        return view('users.admin.admins', compact('admins'));
    }

    public function roles()
    {
        $roles = [
            'admin' => 'Administrator',
            'teacher' => 'Teacher',
            'student' => 'Student',
        ];

        $roleCounts = $this->userRepository->getRoleCounts();
        $users = $this->userRepository->getAllWithRelations();

        return view('users.admin.roles', compact('roles', 'roleCounts', 'users'));
    }

    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,teacher,student',
        ]);

        $this->userRepository->update($id, ['role' => $request->role]);

        return redirect()->route('admin.roles.index')->with('success', 'User role updated successfully.');
    }

    public function permissions()
    {
        $permissions = [
            'admin' => [
                'Manage users and roles',
                'View all reports',
                'Manage fee structure and payments',
                'Configure school settings',
            ],
            'teacher' => [
                'Mark attendance',
                'View student details',
                'Manage assignments and exams',
            ],
            'student' => [
                'View own profile and timetable',
                'Access attendance and results',
                'View fee details',
            ],
        ];

        return view('users.admin.permissions', compact('permissions'));
    }
}
