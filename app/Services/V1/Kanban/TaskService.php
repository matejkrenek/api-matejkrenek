<?php

namespace App\Services\V1\Kanban;

use App\Models\Kanban\KanbanColumn;
use App\Models\Task\Task;
use Illuminate\Http\Request;

class TaskService
{

    public function add(Request $request, KanbanColumn $column)
    {
        Task::create([
            'column_id' => $column->id,
            'author_id' => $request->user()->id,
            'name' => $request->get('name'),
            'row' => $column->tasks->count() + 1,
            'description' => $request->has('description') ? $request->get('description') : null,
        ]);
    }

    public function edit(Request $request, Task $task)
    {
        $task->update([
            'name' => $request->has('name') ? $request->get('name') : $task->name,
            'description' => $request->has('description') ? $request->get('description') : $task->description,
            'executor_id' => $request->has('executor_id') ? $request->get('executor_id') : $task->executor_id,
            'row' => $request->has('row') ? $request->get('row') : $task->row,
            'is_completed' => $request->has('is_completed') ? $request->get('is_completed') : $task->is_completed,
        ]);
    }

    public function delete(Task $task)
    {
        $task->delete();
    }
}
