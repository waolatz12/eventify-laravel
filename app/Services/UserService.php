<?php

namespace App\Services;
use App\Models\User;

class UserService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function createUser (array $data){
        return User::create($data);
    }
}
