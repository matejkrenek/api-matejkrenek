<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/users')->group(base_path("routes/api/v1/api.users.php"));
Route::prefix('/products')->group(base_path("routes/api/v1/api.products.php"));