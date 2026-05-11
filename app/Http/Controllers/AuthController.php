<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Repositeries\UserRepository;

class AuthController extends Controller
{
    protected $userService;
    protected $userRepository;

    public function __construct(
        UserService $userService,
        UserRepository $userRepository
    )
    {
        $this->userService = $userService;
        $this->userRepository = $userRepository;
    }

    public function register()
    {
        $users = $this->userRepository->getAll();
        return view('users.admin.register', compact('users'));
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);
        
        $this->userService->register($request->all(), $request->file('image'));
        
        return redirect()->route('admin.dashboard')->with('success', 'User registered successfully!');
    }

    public function login()
    {
        return view('users.admin.login');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
}
