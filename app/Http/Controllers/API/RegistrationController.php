<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResendVerificationRequest;
use App\Services\UserService;
use App\Services\RegistrationService;
use App\Http\Requests\Registration\StoreRegistrationRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function __construct(private RegistrationService $registrationService)
    {

    }

    public function register (StoreRegistrationRequest $request){
        try {

            //create a user using the UserService dependency
            $user = $this->registrationService->register($request->validated());

            return response()->json([
                'status' => 'success',
                'message' => "User Created Successfully",
                'data' => $user,
            ], 201);
        } catch (\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    public function resendVerification(ResendVerificationRequest $request)
    {
        return $this->registrationService
            ->resendVerification(
            $request->validated()['email']
        );
    }

}
