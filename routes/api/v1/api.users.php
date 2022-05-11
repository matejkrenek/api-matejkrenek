<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', function(Request $request) {
    return [
        'url' => $request->origin()
    ];
});
