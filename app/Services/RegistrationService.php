<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class RegistrationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function register (array $data){
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);

        try {
            $user->sendEmailVerificationNotification();
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
        }

        return $user;
    }
}
