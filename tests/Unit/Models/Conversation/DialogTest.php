<?php

use App\Models\Conversation\Dialogue;

it("has an initiator", function () {
    $dialogue = Dialogue::factory()->make();

    expect($dialogue->initiator)
        ->not()
        ->toBeNull();
});

it("has an interlocutor", function () {
    $dialogue = Dialogue::factory()->make();

    expect($dialogue->interlocutor)
        ->not()
        ->toBeNull();
});

it("can be blocked", function () {
    $dialogue = Dialogue::factory()->make();

    expect($dialogue->blocked)->toBeFalsy();

    $dialogue->block();

    expect($dialogue->blocked)->toBeTruthy();
});

it("can be unblocked", function () {
    $dialogue = Dialogue::factory()->blocked()->make();

    expect($dialogue->blocked)->toBeTruthy();

    $dialogue->unblock();

    expect($dialogue->blocked)->toBeFalsy();
});
