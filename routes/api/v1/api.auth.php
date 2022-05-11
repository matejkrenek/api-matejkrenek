<?php

use App\Facades\API;
use Illuminate\Support\Facades\Route;

Route::get('/login', [API::controller(Auth\AuthController::class), 'login']);
