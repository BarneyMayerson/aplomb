<?php

use App\Models\Conversation\Dialogue;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('requires authentication', function () {
    get(
        route('cabinet.dialogues.show', Dialogue::factory()->create())
    )->assertRedirect(route('login'));
});

it('can be shown to the initiator', function () {
    $dialogue = Dialogue::factory()->create();

    actingAs($dialogue->initiator)
        ->get(route('cabinet.dialogues.show', $dialogue))
        ->assertOk();
});

it('can be shown to the interlocutor', function () {
    $dialogue = Dialogue::factory()->create();

    actingAs($dialogue->interlocutor)
        ->get(route('cabinet.dialogues.show', $dialogue))
        ->assertOk();
});

it('cannot be shown to a stranger', function () {
    $dialogue = Dialogue::factory()->create();

    actingAs(User::factory()->create())
        ->get(route('cabinet.dialogues.show', $dialogue))
        ->assertForbidden();
});
