<?php

namespace App\Services\V1\Kanban;

use App\Mail\Kanban\KanbanInvitation as MailKanbanInvitation;
use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanInvitation;
use App\Models\User\UserKanban;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KanbanService
{
    public function get(Request $request): Collection
    {
        return $request->user()->kanbans()->find($request->id);
    }

    public function edit(Request $request, Kanban $kanban): void
    {
        $kanban->fill([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);

        $kanban->update($kanban->getDirty());
    }

    public function invite(Request $request, Kanban $kanban): void
    {
        $invitation = KanbanInvitation::create([
            'kanban_id' => $kanban->id,
            'author_id' => $request->user()->id,
            'token' => Str::random(40),
            'user_id' => (int)$request->get('user_id')
        ]);
    }

    public function acceptInvitation(KanbanInvitation $kanbanInvitation)
    {
        DB::transaction(function ($kanbanInvitation) {
            UserKanban::create([
                'user_id' => $kanbanInvitation->user_id,
                'kanban_id' => $kanbanInvitation->kanban_id,
            ]);

            $kanbanInvitation->delete();
        });
    }

    public function rejectInvitation(KanbanInvitation $kanbanInvitation)
    {
        $kanbanInvitation->delete();
    }
}
