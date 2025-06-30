<?php

namespace App\Http\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function findByEmail(string $email) : User|null
    {
        return User::where('email', $email)->first();
    }

    public function createUser(UserRequest $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
