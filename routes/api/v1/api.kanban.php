<?php

use App\Http\Controllers\API\V1\Kanban;
use Illuminate\Support\Facades\Route;

Route::prefix('/kanban')->middleware('auth:sanctum')->group(function () {
    Route::controller(Kanban\KanbanController::class)->group(function () {
        Route::get('/{kanban}', 'get')->can('view', 'kanban');
        Route::post('/{kanban}/invite', 'invite')->can('view', 'kanban');
        Route::post('/invitation/{kanbanInvitation:token}/accept', 'accept')->can('accept', 'kanbanInvitation');
        Route::post('/invitation/{kanbanInvitation:token}/reject', 'reject')->can('reject', 'kanbanInvitation');
    });

    Route::controller(Kanban\ColumnController::class)->group(function () {
        Route::post('/{kanban}/column', 'add');
        Route::put('/{kanban}/column/{column}', 'edit');
        Route::delete('/{kanban}/column/{column}', 'delete');
    });

    Route::controller(Kanban\TaskController::class)->group(function () {
        Route::post('/{kanban}/task', 'add');
        Route::put('/{kanban}/task/{task}', 'edit');
        Route::delete('/{kanban}/task/{task}', 'delete');
    });
});
