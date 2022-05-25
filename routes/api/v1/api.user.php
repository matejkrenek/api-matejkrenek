<?php

use App\Http\Controllers\API\V1\User;
use Illuminate\Support\Facades\Route;

Route::prefix('/user')->controller(User\UserController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/kanbans', 'getKanbans');
});
