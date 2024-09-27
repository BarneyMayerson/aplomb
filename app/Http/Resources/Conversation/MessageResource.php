<?php

namespace App\Http\Resources\Conversation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'from' => $this->user->game_username,
            'to' => $this->receiver->game_username,
            'text' => $this->text,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
