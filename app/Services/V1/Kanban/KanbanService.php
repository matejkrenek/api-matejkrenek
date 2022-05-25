<?php

namespace App\Services\V1\Kanban;

use App\Mail\Kanban\KanbanInvitation as MailKanbanInvitation;
use App\Models\Kanban\KanbanInvitation;
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
}
