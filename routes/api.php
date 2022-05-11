<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

$version = config('api.version');

Route::prefix("/{$version}")->group(function() {
    Route::prefix('/users')->group(base_path("routes/api/{$version}/api.users.php"));
    Route::prefix('/products')->group(base_path("routes/api/{$version}/api.products.php"));
});
