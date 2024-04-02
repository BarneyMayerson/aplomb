<?php

use App\Models\Conversation\Dialogue;
use App\Models\User;

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

it("can detemine whether a user is the member", function () {
    $dialogue = Dialogue::factory()->make();

    $user = User::factory()->create();

    expect($dialogue->isMember($user->id))->toBeFalsy();
    expect($dialogue->isMember($dialogue->initiator->id))->toBeTruthy();
    expect($dialogue->isMember($dialogue->interlocutor->id))->toBeTruthy();
});
