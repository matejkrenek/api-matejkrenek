<?php

namespace App\Http\Resources\V1\Kanban;

use App\Http\Resources\V1\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class KanbanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'author' => new UserResource($this->author),
            'columns' => KanbanColumnResource::collection($this->columns),
            'members' => UserResource::collection($this->members),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
