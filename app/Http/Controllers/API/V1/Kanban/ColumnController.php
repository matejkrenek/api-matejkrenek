<?php

namespace App\Http\Controllers\API\V1\Kanban;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Kanban\ColumnRequest;
use App\Http\Resources\V1\Kanban\KanbanColumnResource;
use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanColumn;
use App\Services\V1\Kanban\ColumnService;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function __construct(protected ColumnService $columnService)
    {
    }

    public function getAll(Request $request, Kanban $kanban)
    {
        return KanbanColumnResource::collection($kanban->columns);
    }

    public function add(ColumnRequest $request, Kanban $kanban)
    {
        try {
            $column = $this->columnService->add($request, $kanban);
            return [
                'message' => 'column added',
                'data' => new KanbanColumnResource($column)
            ];
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }
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
            'message' => 'column updated',
            'data' => new KanbanColumnResource($column)
        ];
    }

    public function delete(Kanban $kanban, KanbanColumn $column)
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
