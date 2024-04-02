<?php

namespace App\Policies\Conversation;

use App\Models\Conversation\Dialogue;
use App\Models\User;

class DialoguePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Dialogue $dialogue): bool
    {
        return $dialogue->isMember($user->id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Dialogue $dialogue): bool
    {
        return $dialogue->isMember($user->id);
    }
}
