<?php

namespace App\Http\Resources\V1\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function __construct($resource, $token = null)
    {
        $this->resource = $resource;
        $this->token = $token;
    }

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
            "username" => $this->username,
            "email" => $this->email,
            "token" => $this->when($this->token, $this->token),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
