<?php

use App\Http\Resources\Conversation\DialogueResource;
use App\Models\Conversation\Dialogue;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it("requires authentication", function () {
    get(route("cabinet.dialogues.index"))->assertRedirect(route("login"));
});

it("should return the correct component", function () {
    actingAs(User::factory()->create());

    get(route("cabinet.dialogues.index"))->assertComponent(
        "User/Cabinet/Dialogues/Index"
    );
});

it("passes user's dialogues to the view", function () {
    $user = User::factory()->create();

    $dialogues = Dialogue::factory()
        ->count(3)
        ->create([
            "initiator_id" => $user->id,
        ]);

    $dialogues->load(["initiator", "interlocutor"]);

    actingAs($user);

    get(route("cabinet.dialogues.index"))->assertHasResource(
        "dialogues",
        DialogueResource::collection($dialogues)
    );
});
