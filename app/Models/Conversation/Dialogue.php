<?php

namespace App\Models\Conversation;

use App\Models\User;
use DomainException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Dialogue extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $casts = [
        "blocked" => "boolean",
    ];

    public function initiator(): BelongsTo
    {
        return $this->belongsTo(User::class, "initiator_id");
    }

    public function interlocutor(): BelongsTo
    {
        return $this->belongsTo(User::class, "interlocutor_id");
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

    /**
     * @param string $initiator_id
     * @param string $interlocutor_id
     * @return Dialogue
     * @throws DomainException
     */
    public static function safetyCreate(
        string $initiator_id,
        string $interlocutor_id
    ): self {
        // Check if it already exists between those people
        if (
            static::where("initiator_id", $interlocutor_id)
                ->where("interlocutor_id", $initiator_id)
                ->exists()
        ) {
            throw new DomainException("Such a dialogue is already exists.");
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
