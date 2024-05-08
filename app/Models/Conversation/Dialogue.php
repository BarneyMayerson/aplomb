<?php

namespace App\Models\Conversation;

use App\Models\User;
use DomainException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class Dialogue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected function casts(): array
    {
        return [
            "blocked" => "boolean",
        ];
    }

    public function initiator(): BelongsTo
    {
        return $this->belongsTo(User::class, "initiator_id");
    }

    public function interlocutor(): BelongsTo
    {
        return $this->belongsTo(User::class, "interlocutor_id");
    }

    public function isMember(int $userId): bool
    {
        return $this->initiator->id === $userId ||
            $this->interlocutor->id === $userId;
    }

    public function partner(): ?User
    {
        if (Auth::guest()) {
            return null;
        }

        if (!$this->isMember(Auth::id())) {
            return null;
        }

        return Auth::id() === $this->initiator_id
            ? $this->interlocutor
            : $this->initiator;
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function block(): void
    {
        $this->blocked = true;
    }

    public function unblock(): void
    {
        $this->blocked = false;
    }

    public static function allByUser(int $userId): Collection
    {
        return Dialogue::where("initiator_id", $userId)
            ->orWhere("interlocutor_id", $userId)
            ->with(["initiator", "interlocutor"])
            ->get();
    }

    /**
     * @param string $initiator_id
     * @param string $interlocutor_id
     * @return Dialogue
     * @throws DomainException
     */
    public static function findOrCreate(
        string $initiator_id,
        string $interlocutor_id
    ): self {
        // Check if it already exists between those people
        if (
            static::where("initiator_id", $interlocutor_id)
                ->where("interlocutor_id", $initiator_id)
                ->exists()
        ) {
            return static::where("initiator_id", $interlocutor_id)
                ->where("interlocutor_id", $initiator_id)
                ->first();
        }

        return static::firstOrCreate([
            "initiator_id" => $initiator_id,
            "interlocutor_id" => $interlocutor_id,
        ]);
    }

    public function addMessage(int $userId, int $recieverId, string $text): void
    {
        Message::add($this->id, $userId, $recieverId, $text);
    }
}
