<?php

namespace App\Services\V1\Kanban;

use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanColumn;
use Illuminate\Http\Request;

class ColumnService
{

    public function add(Request $request, Kanban $kanban)
    {
        KanbanColumn::create([
            'kanban_id' => $kanban->id,
            'name' => $request->get('name'),
            'color' => '#eeeeee',
            'order' => $kanban->columns->count() + 1
        ]);
    }

    public function edit(Request $request, KanbanColumn $column)
    {
        $column->update([
            'name' => $request->has('name') ? $request->get('name') : $column->name,
            'color' => $request->has('color') ? $request->get('color') : $column->color,
            'order' => $request->has('order') ? $request->get('order') : $column->order
        ]);
    }

    public function delete(KanbanColumn $column)
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
}
