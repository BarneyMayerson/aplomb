<?php

namespace App\Models\Conversation;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function dialogue(): BelongsTo
    {
        return $this->belongsTo(Dialogue::class);
    }

    public static function add(
        int $dialogueId,
        int $userId,
        int $receiverId,
        string $text
    ): void {
        self::create([
            'dialogue_id' => $dialogueId,
            'user_id' => $userId,
            'receiver_id' => $receiverId,
            'text' => $text,
        ]);
    }
}
