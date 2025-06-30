<?php

namespace App\Http\Controllers;

use App\Http\Repositories\UserRepositoryInterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct(
        protected readonly AuthService $authService,
        protected readonly UserRepositoryInterface $userRepository
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.auth.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.auth.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {

        $user = $this->userRepository->createUser($request);

        Auth::login($user);

        return redirect()->route('task.index');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(LoginRequest $request)
    {
        if ($this->authService->authenticate(
            $request->email,
            $request->password,
            $request
        )) {
            return redirect()->intended('tasks');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

}
