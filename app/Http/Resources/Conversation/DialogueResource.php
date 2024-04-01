<?php

namespace App\Http\Resources\Conversation;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DialogueResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "initiator" => UserResource::make($this->whenLoaded("initiator")),
            "interlocutor" => UserResource::make(
                $this->whenLoaded("interlocutor")
            ),
            "blocked" => $this->blocked,
        ];
    }
}
