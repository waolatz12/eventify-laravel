<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
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
Route::prefix('v1')->group(function () {
    // Route::get(
    //     '/email/verify/{id}/{hash}',
    //     [App\Http\Controllers\API\EmailVerificationController::class, 'verify']
    // )
    // ->middleware(['signed'])
    // ->name('verification.verify');
    // Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    //     $request->fulfill();
    //     return response()->json(['message' => 'Email verified successfully.']);
    // })->middleware(['signed'])->name('verification.verify'); // Signed middleware protects tampering

    Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {

        // 1. Manually fetch the user from the route parameter
        $user = User::findOrFail($id);

        // 2. Cryptographically verify the signature hasn't been altered or expired
        if (! $request->hasValidSignature()) {
            return response()->json(['message' => 'Invalid or expired verification link.'], 403);
        }

        // 3. Verify that the email hash matches the user's current email
        if (! hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Invalid verification hash.'], 403);
        }

        // 4. Mark as verified if they aren't already
        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email is already verified.']);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user)); // Fire Laravel's core verification events
        }

        // 5. Perfect for API: Return a JSON success response
        return response()->json(['message' => 'Email verified successfully!']);
    })->middleware(['signed'])->name('v1.verification.verify');

    Route::post('/email/resend', [App\Http\Controllers\API\RegistrationController::class, 'resendVerification']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
    Route::get('/auth/google', [App\Http\Controllers\GoogleController::class, 'googleloginpage']);
    Route::get('/auth/google/callback', [App\Http\Controllers\GoogleController::class, 'googleLoginCallback']);
    Route::post('/register', [App\Http\Controllers\API\RegistrationController::class, 'register'])->middleware('throttle:10,1'); //maximum of 10 request per minute
    Route::post('/forgot-password', [App\Http\Controllers\API\AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [App\Http\Controllers\API\AuthController::class, 'resetPassword']);
    Route::post('/user/{user}/events/register', [App\Http\Controllers\EventController::class, 'register']);
    Route::middleware(['auth:sanctum', 'throttle:api'])->group(function () {
        Route::prefix('events')->group(function () {
            Route::post('/', [App\Http\Controllers\EventController::class, 'create'])->middleware('permission:create-event'); //use gate to ensure that only organizers and admins can create events
            Route::get('/', [App\Http\Controllers\EventController::class, 'getAllEvents']);
            Route::post('/{event}/tickets', [App\Http\Controllers\TicketController::class, 'store']); //create ticket
            Route::patch('/{event}', [App\Http\Controllers\EventController::class, 'update']);
            Route::delete('/{event}', [App\Http\Controllers\EventController::class, 'delete']);
            Route::get('/{event}', [App\Http\Controllers\EventController::class, 'show']);
        });
        Route::post('logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
        Route::get('/profile', function (Request $request) {
            return $request->user()->profile;
        });

        Route::post('/profile', function (Request $request) {
            // Update user profile logic
        });
    });

    Route::middleware(['auth:sanctum', 'admin'])->group(function () {});
});

// Route::middleware('auth:sanctum')->get('/sanctum-test', function () {
//     return response()->json([
//         'success' => true
//     ]);
// });
