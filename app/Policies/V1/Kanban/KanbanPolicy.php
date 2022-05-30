<?php

namespace App\Policies\V1\Kanban;

use App\Models\Kanban\Kanban;
use App\Models\User\User;

class KanbanPolicy
{

    public function view(User $user, Kanban $kanban)
    {
        return $user->kanbans->contains($kanban);
    }
}
