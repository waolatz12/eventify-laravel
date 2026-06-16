<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

//verify the email
// Route::get('/email/verify/{id}/{hash}', function (
//     EmailVerificationRequest $request
// ) {
//     $request->fulfill();

//     return response()->json([
//         'message' => 'Email verified successfully'
//     ]);
// })->middleware([
//     'auth:sanctum',
//     'signed'
// ])->name('verification.verify');

Route::get(
    '/email/verify/{id}/{hash}',
    [App\Http\Controllers\API\EmailVerificationController::class, 'verify']
)
->middleware(['signed'])
->name('verification.verify');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::get('/auth/google', [App\Http\Controllers\GoogleController::class, 'googleloginpage']);
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleController::class, 'googleLoginCallback']);
Route::post('/register',[App\Http\Controllers\API\RegistrationController::class, 'register']);
Route::post('/user/{user}/events/register',[App\Http\Controllers\EventController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/events/create',[App\Http\Controllers\EventController::class, 'create']);
    Route::get('/profile', function (Request $request) {
        return $request->user()->profile;
    });

    Route::post('/profile', function (Request $request) {
        // Update user profile logic
    });
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

});

// Route::middleware('auth:sanctum')->get('/sanctum-test', function () {
//     return response()->json([
//         'success' => true
//     ]);
// });
