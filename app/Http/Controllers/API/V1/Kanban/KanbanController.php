<?php

namespace App\Http\Controllers\API\V1\Kanban;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Kanban\InvitationRequest;
use App\Http\Resources\V1\Kanban\KanbanResource;
use App\Models\Kanban\Kanban;
use App\Services\V1\Kanban\KanbanService;
use Illuminate\Http\Request;
use Symfony\Component\Mailer\Exception\TransportException;

class KanbanController extends Controller
{
    public function __construct(protected KanbanService $kanbanService)
    {
    }

    public function get(Request $request)
    {
        $kanban = $this->kanbanService->get($request);

        if (!$kanban) abort(404);

        return new KanbanResource($kanban);
    }

    public function invite(InvitationRequest $request)
    {
        try {
            $this->kanbanService->invite($request);
        } catch (TransportException $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'email sended'
        ];
    }
}
