<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\User;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct(private AuthService $authService) {}


    public function logout(Request $request)
    {
        return response()->json(
            $this->authService->logout($request->user())
        );
    }

    public function register(Request $request)
    {
        try {
            $data = $request->all();
            $data['password'] = Hash::make('password');
            $service = new UserService();

            $user = $service->createUser($data);

            return response()->json([
                'status' => 'success',
                'message' => "User Created Successfully",
                'data' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function login(LoginRequest $request)
    {
        try {

            $response = $this->authService
                ->login(
                    $request->validated()
                );

            return response()->json([
                'status' => 'success',
                'message' => 'Login Successful',
                'data' => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),

            ], 401);
        }
    }

    //forgot password request
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        return response()->json(
            $this->authService
                ->forgotPassword(
                    $request->email
                )
        );
    }

    //reset password that actually reset the user's password
    public function resetPassword(ResetPasswordRequest $request)
    {
        return response()->json(
            $this->authService
                ->resetPassword(
                    $request->validated()
                )
        );
    }
}
