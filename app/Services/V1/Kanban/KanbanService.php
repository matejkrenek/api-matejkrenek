<?php

namespace App\Services\V1\Kanban;

use App\Mail\Kanban\KanbanInvitation as MailKanbanInvitation;
use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class KanbanService
{
    public function get(Request $request)
    {
        return $request->user()->kanbans()->find($request->id);
    }

    public function invite(Request $request, Kanban $kanban)
    {
        $invitation = KanbanInvitation::create([
            'kanban_id' => $kanban->id,
            'author_id' => $request->user()->id,
            'token' => Str::random(40),
            'email' => $request->get('email')
        ]);
    }
}
