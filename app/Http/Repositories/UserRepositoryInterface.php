<?php

namespace App\Http\Repositories;

use App\Http\Requests\UserRequest;
use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * Find a user by their email address.
     *
     * @param string $email
     *     The email address to search for.
     *
     * @return \App\Models\User|null
     *     The user instance if found, or null if not found.
     */
    public function findByEmail(string $email) : User|null;

    /**
     * Create a new user using the provided request data.
     *
     * @param \App\Http\Requests\UserRequest $data
     *     The request object containing validated user data.
     *
     * @return \App\Models\User
     *     The newly created user instance.
     */
    public function createUser(UserRequest $data): User;
}
