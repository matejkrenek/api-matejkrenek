<?php

namespace App\Services\V1\Kanban;

use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanColumn;
use Illuminate\Http\Request;

class ColumnService
{

    public function add(Request $request, Kanban $kanban)
    {
        return KanbanColumn::create([
            'kanban_id' => $kanban->id,
            'name' => $request->get('name'),
            'color' => '#eeeeee',
            'order' => $kanban->columns->count() + 1
        ]);
    }

    public function edit(Request $request, KanbanColumn $column)
    {
        $column->fill([
            'name' => $request->has('name') ? $request->get('name') : $column->name,
            'color' => $request->has('color') ? $request->get('color') : $column->color,
        ]);

        if ($request->has('order') && $column->order !== (int)$request->get('order')) {
            $direction = (int)$request->get('order') > $column->order ? 'right' : 'left';

            switch ($direction) {
                case 'right':
                    $columns = KanbanColumn::where('kanban_id', $column->kanban_id)->where('order', '>', $column->order)->where('order', '<=', (int)$request->get('order'))->get();
                    $column->order = (int)$request->get('order');
                    $column->save();

                    foreach ($columns as $col) {
                        $col->order -= 1;
                        $col->save();
                    }

                    return;
                case 'left':
                    $columns = KanbanColumn::where('kanban_id', $column->kanban_id)->where('order', '<', $column->order)->where('order', '>=', (int)$request->get('order'))->get();
                    $column->order = (int)$request->get('order');
                    $column->save();

                    foreach ($columns as $col) {
                        $col->order += 1;
                        $col->save();
                    }
                    break;
                default:
                    break;
            }
        }

        $column->save();
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
