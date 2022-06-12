<?php

use App\Http\Controllers\API\V1\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->controller(Auth\AuthController::class)->group(function () {
    Route::post('/login', 'login')->middleware('guest');
    Route::post('/register', 'register')->middleware('guest');
    Route::get('/me', 'me')->middleware('auth:sanctum');
    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});
