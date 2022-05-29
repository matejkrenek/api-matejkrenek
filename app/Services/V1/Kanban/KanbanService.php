<?php

namespace App\Services\V1\Kanban;

use App\Mail\Kanban\KanbanInvitation as MailKanbanInvitation;
use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanColumn;
use App\Models\Kanban\KanbanInvitation;
use App\Models\Task\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class KanbanService
{
    public function get(Request $request)
    {
        return $request->user()->kanbans()->find($request->id);
    }

    public function invite(Request $request)
    {
        $kanban = $this->get($request);

        if (!$kanban) abort(404, 'Kanban not found');


        $invitation = KanbanInvitation::create([
            'kanban_id' => $kanban->id,
            'author_id' => $request->user()->id,
            'email' => $request->get('email')
        ]);

        Mail::to($invitation->email)->send(new MailKanbanInvitation($invitation));
    }

    public function addColumn(Request $request, Kanban $kanban)
    {
        KanbanColumn::create([
            'kanban_id' => $kanban->id,
            'name' => $request->get('name'),
            'color' => '#eeeeee',
            'order' => $kanban->columns->count() + 1
        ]);
    }

    public function editColumn(Request $request, KanbanColumn $column)
    {
        $column->update([
            'name' => $request->has('name') ? $request->get('name') : $column->name,
            'color' => $request->has('color') ? $request->get('color') : $column->color,
            'order' => $request->has('order') ? $request->get('order') : $column->order
        ]);
    }

    public function deleteColumn(KanbanColumn $column)
    {
        $column->delete();
        $columns = KanbanColumn::where('kanban_id', $column->kanban_id)->get();

        foreach ($columns as $col) {
            if ($col->order > $column->order) {
                $col->order -= 1;
            }
            $col->save();
        }
    }

    public function addTask(Request $request, KanbanColumn $column)
    {
        Task::create([
            'column_id' => $column->id,
            'author_id' => $request->user()->id,
            'name' => $request->get('name'),
            'row' => $column->tasks->count() + 1,
            'description' => $request->has('description') ? $request->get('description') : null,
        ]);
    }

    public function editTask(Request $request, Task $task)
    {
        $task->update([
            'name' => $request->has('name') ? $request->get('name') : $task->name,
            'description' => $request->has('description') ? $request->get('description') : $task->description,
            'executor_id' => $request->has('executor_id') ? $request->get('executor_id') : $task->executor_id,
            'row' => $request->has('row') ? $request->get('row') : $task->row,
            'is_completed' => $request->has('is_completed') ? $request->get('is_completed') : $task->is_completed,
        ]);
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
    }
}
