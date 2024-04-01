<?php

namespace Database\Factories\Conversation;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conversation\Dialog>
 */
class DialogueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "initiator_id" => User::factory(),
            "interlocutor_id" => User::factory(),
            "blocked" => false,
        ];
    }

    public function blocked(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                "blocked" => true,
            ];
        });
    }
}
