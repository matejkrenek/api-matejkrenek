<?php

namespace App\Http\Controllers\API\V1\Kanban;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Kanban\ColumnRequest;
use App\Http\Requests\V1\Kanban\InvitationRequest;
use App\Http\Requests\V1\Kanban\TaskRequest;
use App\Http\Resources\V1\Kanban\KanbanResource;
use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanColumn;
use App\Models\Task\Task;
use App\Services\V1\Kanban\KanbanService;
use Illuminate\Http\Request;
use Symfony\Component\Mailer\Exception\TransportException;

class KanbanController extends Controller
{
    public function __construct(protected KanbanService $kanbanService)
    {
    }

    public function get(Request $request)
    {
        $kanban = $this->kanbanService->get($request);

        if (!$kanban) abort(404);

        return new KanbanResource($kanban);
    }

    public function invite(InvitationRequest $request)
    {
        try {
            $this->kanbanService->invite($request);
        } catch (TransportException $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'email sended'
        ];
    }

    public function addColumn(ColumnRequest $request, Kanban $kanban)
    {
        try {
            $this->kanbanService->addColumn($request, $kanban);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'column added'
        ];
    }

    public function editColumn(ColumnRequest $request, Kanban $kanban, KanbanColumn $column)
    {
        try {
            $this->kanbanService->editColumn($request, $column);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'column updated'
        ];
    }

    public function deleteColumn(Kanban $kanban, KanbanColumn $column)
    {
        try {
            $this->kanbanService->deleteColumn($column);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'column deleted'
        ];
    }

    public function addTask(TaskRequest $request, Kanban $kanban, KanbanColumn $column)
    {
        try {
            $this->kanbanService->addTask($request, $column);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'task added'
        ];
    }

    public function editTask(TaskRequest $request, Kanban $kanban, KanbanColumn $column, Task $task)
    {
        try {
            $this->kanbanService->editTask($request, $task);
        } catch (\Throwable $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'task updated'
        ];
    }

    public function deleteTask(Kanban $kanban, KanbanColumn $column, Task $task)
    {
        try {
            $this->kanbanService->deleteTask($task);
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
