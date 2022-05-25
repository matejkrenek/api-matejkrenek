<?php

use App\Http\Controllers\API\V1\Kanban;
use Illuminate\Support\Facades\Route;

Route::prefix('/kanban')->controller(Kanban\KanbanController::class)->middleware('auth:sanctum')->group(function () {
    Route::get('/{id}', 'get');
    Route::post('/{id}/invite', 'invite');
    Route::post('/invitation/{token}/accept', 'accept');
    Route::post('/invitation/{token}/reject', 'accept');
});
