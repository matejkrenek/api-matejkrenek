<?php

namespace App\Policies\V1\Kanban;

use App\Models\Kanban\KanbanInvitation;
use App\Models\User\User;

class KanbanInvitationPolicy
{
    public function accept(User $user, KanbanInvitation $kanbanInvitation)
    {
        return $user->invitations->contains($kanbanInvitation);
    }

    public function reject(User $user, KanbanInvitation $kanbanInvitation)
    {
        return $user->invitations->contains($kanbanInvitation);
    }
}
