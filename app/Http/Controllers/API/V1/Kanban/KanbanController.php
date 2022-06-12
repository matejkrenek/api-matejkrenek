<?php

namespace App\Http\Controllers\API\V1\Kanban;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Kanban\InvitationRequest;
use App\Http\Requests\V1\Kanban\KanbanRequest;
use App\Http\Resources\V1\Kanban\KanbanResource;
use App\Models\Kanban\Kanban;
use App\Models\Kanban\KanbanInvitation;
use App\Services\V1\Kanban\KanbanService;
use Illuminate\Http\Request;
use Symfony\Component\Mailer\Exception\TransportException;

class KanbanController extends Controller
{
    public function __construct(protected KanbanService $kanbanService)
    {
    }

    public function getAll(Request $request)
    {
        return KanbanResource::collection($request->user()->kanbans);
    }

    public function get(Request $request, Kanban $kanban)
    {
        return new KanbanResource($kanban);
    }

    public function edit(KanbanRequest $request, Kanban $kanban)
    {
        try {
            $this->kanbanService->edit($request, $kanban);
        } catch (TransportException $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'Kanban edited',
            'data' => new KanbanResource($kanban)
        ];
    }

    public function invite(InvitationRequest $request, Kanban $kanban)
    {
        try {
            $this->kanbanService->invite($request, $kanban);
        } catch (TransportException $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'email sended'
        ];
    }

    public function accept(KanbanInvitation $kanbanInvitation)
    {
        try {
            $this->kanbanService->acceptInvitation($kanbanInvitation);
        } catch (TransportException $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'invitation accepted'
        ];
    }

    public function reject(KanbanInvitation $kanbanInvitation)
    {
        try {
            $this->kanbanService->rejectInvitation($kanbanInvitation);
        } catch (TransportException $e) {
            return [
                'message' => $e->getMessage()
            ];
        }

        return [
            'message' => 'invitation accepted'
        ];
    }
}
