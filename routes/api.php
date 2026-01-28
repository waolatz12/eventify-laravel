<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);
Route::get('/auth/google', [App\Http\Controllers\GoogleController::class, 'googleloginpage']);
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleController::class, 'googleLoginCallback']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', function (Request $request) {
        return $request->user()->profile;
    });

    Route::post('/profile', function (Request $request) {
        // Update user profile logic
    });
});
