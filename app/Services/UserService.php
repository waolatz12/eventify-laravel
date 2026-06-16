<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $password = Hash::make($data['password']);
        $data['password'] = $password;
        return User::create($data);
    }
}
