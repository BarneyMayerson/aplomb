<?php

use App\Models\Conversation\Dialogue;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->initiator = User::factory()->create();
    $this->interlocutor = User::factory()->create();

    $this->validData = [
        "from" => $this->initiator->id,
        "to" => $this->interlocutor->id,
        "message" => "Hi there!",
    ];
});

it("requires authentication", function () {
    post(route("cabinet.dialogue.store"))->assertRedirect(route("login"));
});

it(
    "store a dialog in which the authenticated user starts a conversation with another",
    function () {
        actingAs($this->initiator)->post(
            route("cabinet.dialogue.store", $this->validData)
        );

        assertDatabaseHas(Dialogue::class, [
            "initiator_id" => $this->initiator->id,
            "interlocutor_id" => $this->interlocutor->id,
        ]);
    }
);

it("requires a valid data", function (array $badData, array|string $errors) {
    actingAs($this->initiator)
        ->post(route("cabinet.dialogue.store"), [
            ...$this->validData,
            ...$badData,
        ])
        ->assertInvalid($errors);
})->with([
    [["from" => null], "from"], // required
    [["from" => "str"], "from"], // numeric
    [["to" => 1], "from"], // different of 'to'
    [["from" => 10000], "from"], // exists in db table

    [["to" => null], "to"],
    [["to" => "str"], "to"],
    [["to" => 10000], "to"],
]);

it(
    "doesn't create a new dialog between the interlocutor and the previous initiator",
    function () {
        actingAs($this->initiator)->post(
            route("cabinet.dialogue.store", $this->validData)
        );

        assertDatabaseHas(Dialogue::class, [
            "initiator_id" => $this->initiator->id,
            "interlocutor_id" => $this->interlocutor->id,
        ]);

        actingAs($this->interlocutor)->post(
            route("cabinet.dialogue.store", [
                "from" => $this->interlocutor->id,
                "to" => $this->initiator->id,
                "message" => "Hi there!",
            ])
        );

        assertDatabaseMissing(Dialogue::class, [
            "initiator_id" => $this->interlocutor->id,
            "interlocutor_id" => $this->initiator->id,
        ]);
    }
);
