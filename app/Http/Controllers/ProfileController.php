<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\AdminService;
use App\Repositeries\UserRepository;

class ProfileController extends Controller
{
    protected $adminService;
    protected $userRepository;

    public function __construct(
        AdminService $adminService,
        UserRepository $userRepository
    )
    {
        $this->adminService = $adminService;
        $this->userRepository = $userRepository;
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('users.admin.update_profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $imagePath = $request->file('image')->store('profile_images', 'public');
            $user->image = $imagePath;
            $user->save();
        }

        $this->userRepository->update($user->id, $request->only(['name', 'email']));

        return redirect()->route('admin.profile.update')->with('success', 'Profile updated successfully!');
    }

    public function showPicProfile($id)
    {
        $user = $this->adminService->findById($id);
        return view('users.admin.pic_to_profile', compact('user'));
    }

    public function show($id)
    {
        $user = $this->adminService->findById($id);
        return view('users.admin.show', compact('user'));
    }
}
