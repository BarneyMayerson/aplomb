<?php

use App\Models\Conversation\Dialogue;
use App\Models\Conversation\Message;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;

beforeEach(function () {
    $this->initiator = User::factory()->create();
    $this->interlocutor = User::factory()->create();
});

it(
    "can store a message from an authenticated user to a dialogue partner",
    function () {
        $dialogue = Dialogue::factory()->create([
            "initiator_id" => $this->initiator->id,
            "interlocutor_id" => $this->interlocutor->id,
        ]);

        actingAs($this->initiator)->post(
            route("cabinet.dialogues.show.add-message", [
                "dialogue" => $dialogue,
                "text" => "Hello",
            ])
        );

        assertDatabaseHas(Message::class, [
            "id" => $dialogue->id,
            "user_id" => $this->initiator->id,
            "receiver_id" => $this->interlocutor->id,
            "text" => "Hello",
        ]);
    }
);
