<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepositoryInterface;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{   
    public function __construct(protected readonly UserRepositoryInterface $userRepository)
    {}

    /**
     * Attempt to authenticate a user by email and password.
     *
     * @param string $email
     *     The email address provided by the user.
     * @param string $password
     *     The plain text password to validate.
     * @param \App\Http\Requests\LoginRequest $request
     *     The request instance used to regenerate session on success.
     *
     * @return bool
     *     True if authentication succeeds, false otherwise.
     */
    public function authenticate(
        string $email, 
        string $password, 
        LoginRequest $request
    ): bool
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();
            return true;
        }

        return false;
    }
}
