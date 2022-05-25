<?php

namespace App\Mail\Kanban;

use App\Models\Kanban\KanbanInvitation as KanbanKanbanInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class KanbanInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(KanbanKanbanInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.kanban.invitation', ['invitation' => $this->invitation]);
    }
}
