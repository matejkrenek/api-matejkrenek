<?php

namespace App\Http\Controllers\API\V1\Kanban;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Kanban\TaskRequest;
use App\Models\Kanban\KanbanColumn;
use App\Models\Task\Task;
use App\Services\V1\Kanban\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    public function add(TaskRequest $request, KanbanColumn $column)
    {
        try {
            $this->taskService->add($request, $column);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'task added'
        ];
    }

    public function edit(TaskRequest $request, Task $task)
    {
        try {
            $this->taskService->edit($request, $task);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'task updated'
        ];
    }

    public function deleteTask(Task $task)
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
