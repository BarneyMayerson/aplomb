<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            "user" => $this->whenLoaded(
                "user",
                fn() => UserResource::make($this->user)
            ),
            "title" => $this->title,
            "body" => $this->body,
            "html" => $this->html,
            "created_at" => $this->created_at,
            "published_at" => $this->published_at ?? null,
            "readonly" => $this->isPublished(),
        ];
    }

    public static function cabinetCollection(
        User $user,
        int $perPage = 12
    ): AnonymousResourceCollection {
        return static::collection(
            $user->posts()->latest()->latest("id")->paginate($perPage)
        );
    }
}
