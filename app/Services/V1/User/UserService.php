<?php

namespace App\Services\V1\User;

use App\Http\Resources\V1\Kanban\KanbanResource;
use Illuminate\Http\Request;

class UserService
{
    public function kanbans(Request $request)
    {
        return KanbanResource::collection($request->user()->kanbans);
    }
}
