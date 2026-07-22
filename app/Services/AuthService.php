<?php

namespace App\Services;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;


class AuthService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function login(array $data): array
    {
        if (! Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {

            throw ValidationException::withMessages([
                'email' => [
                    'Invalid credentials.'
                ]
            ]);
        }

        $user = User::find(Auth::id());
        // dd($user);

        if ($user->role != UserRole::ADMIN) {
            if (! $user->hasVerifiedEmail()) {
                throw ValidationException::withMessages([
                    'email' => [
                        'Please verify your email.'
                    ]
                ]);
            }
        }

        $token = $user
            ->createToken('eventify-token')
            ->plainTextToken;

        dd($token);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    //use : array at the back of a declaration when both expected input and output must be an array
    public function logout(User $user): array
    {
        $user->tokens()->delete();

        return [
            'message' => 'logged out'
        ];
    }

    public function forgotPassword(string $email): array
    {

        //laravel default password reset functionality
        Password::sendResetLink([
            'email' => $email
        ]);


        return [
            'message' =>
            'If the email exists, a password reset link has been sent.'
        ];
    }
    public function resetPassword(array $data): array
    {

        $status = Password::reset(
            $data,

            function (
                $user,
                $password
            ) {

                $user->forceFill([

                    'password' =>
                    Hash::make($password),

                    'remember_token' =>
                    null

                ])->save();
            }
        );


        if (
            $status !== Password::PASSWORD_RESET
        ) {

            throw ValidationException::withMessages([
                'email' =>
                [
                    __($status)
                ]
            ]);
        }


        return [
            'message' =>
            'Password reset successful.'
        ];
    }
}
