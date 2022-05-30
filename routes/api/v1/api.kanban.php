<?php

use App\Http\Controllers\API\V1\Kanban;
use Illuminate\Support\Facades\Route;

Route::prefix('/kanban')->middleware('auth:sanctum')->group(function () {
    Route::controller(Kanban\KanbanController::class)->middleware('can:view,kanban')->group(function () {
        Route::get('/{kanban}', 'get');
        Route::post('/{kanban}/invite', 'invite');
        Route::post('/invitation/{token}/accept', 'accept');
        Route::post('/invitation/{token}/reject', 'accept');
    });

    Route::controller(Kanban\ColumnController::class)->group(function () {
        Route::post('/{kanban}/column', 'add');
        Route::put('/{kanban}/column/{column}', 'edit');
        Route::delete('/{kanban}/column/{column}', 'delete');
    });

    Route::controller(Kanban\TaskController::class)->group(function () {
        Route::post('/{kanban}/column/{column}/task', 'add');
        Route::put('/{kanban}/column/{column}/task/{task}', 'edit');
        Route::delete('/{kanban}/column/{column}/task/{task}', 'delete');
    });
});
