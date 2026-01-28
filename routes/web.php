<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/auth/google', [App\Http\Controllers\GoogleController::class, 'googleloginpage'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [App\Http\Controllers\GoogleController::class, 'googleLoginCallback'])->name('auth.google.callback');
