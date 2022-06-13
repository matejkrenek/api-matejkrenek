<?php

namespace App\Http\Controllers\API\V1\Kanban;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Kanban\TaskRequest;
use App\Http\Resources\V1\Kanban\KanbanTaskResource;
use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanColumn;
use App\Models\Task\Task;
use App\Services\V1\Kanban\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    public function getAll(Request $request, Kanban $kanban)
    {
        return KanbanTaskResource::collection($kanban->tasks);
    }

    public function add(TaskRequest $request, Kanban $kanban)
    {
        try {
            $task = $this->taskService->add($request);
            return [
                'message' => 'task added',
                'data' => new KanbanTaskResource($task)
            ];
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }
    }

    public function edit(TaskRequest $request, Kanban $kanban, Task $task)
    {
        try {
            $this->taskService->edit($request, $task);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'task updated',
            'data' => new KanbanTaskResource($task)
        ];
    }

    public function delete(Kanban $kanban, Task $task)
    {
        try {
            $this->taskService->delete($task);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'task deleted'
        ];
    }
}
