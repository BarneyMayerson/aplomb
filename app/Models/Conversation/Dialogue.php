<?php

namespace App\Models\Conversation;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Dialogue extends Model
{
    use HasFactory;

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

    public function block(): void
    {
        $this->blocked = true;
    }

    public function unblock(): void
    {
        $this->blocked = false;
    }
}
