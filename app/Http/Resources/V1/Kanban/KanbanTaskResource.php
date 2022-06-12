<?php

namespace App\Http\Resources\V1\Kanban;

use App\Http\Resources\V1\User\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class KanbanTaskResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "decription" => $this->decription,
            "column" => new KanbanColumnResource($this->column),
            "author" => new UserResource($this->author),
            "executor" => new UserResource($this->executor),
            "row" => $this->row,
            "is_completed" => $this->is_completed,
            "created_at" => (new Carbon($this->created_at))->format("d. m. Y, H:i"),
            "updated_at" => (new Carbon($this->created_at))->format("d. m. Y, H:i")
        ];
    }
}
