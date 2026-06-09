<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    protected UserService $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

       public function register (Request $request){
        try {
            $data = $request->all();
            $data['password'] = Hash::make('password');
            // $service = new UserService();

            //create a user using the UserService dependency
            $user = $this->userService->createUser($data);

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

}
