<?php

namespace App\Http\Controllers\API\V1\Kanban;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Kanban\ColumnRequest;
use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanColumn;
use App\Services\V1\Kanban\ColumnService;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function __construct(protected ColumnService $columnService)
    {
    }

    public function add(ColumnRequest $request, Kanban $kanban)
    {
        try {
            $this->columnService->add($request, $kanban);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'column added'
        ];
    }

    public function edit(ColumnRequest $request, Kanban $kanban, KanbanColumn $column)
    {
        try {
            $this->columnService->edit($request, $column);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'column updated'
        ];
    }

    public function delete(KanbanColumn $column)
    {
        try {
            $this->columnService->delete($column);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'column deleted'
        ];
    }
}
