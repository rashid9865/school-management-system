<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Repositeries\UserRepository;
use App\Http\Requests\StoreUserRequest;

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

    public function storeUser(StoreUserRequest $request)
    {
        $validated = $request->validated();
        
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
