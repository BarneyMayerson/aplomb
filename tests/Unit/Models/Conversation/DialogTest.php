<?php

use App\Models\Conversation\Dialog;

it("has an initiator", function () {
    $dialog = Dialog::factory()->make();

    expect($dialog->initiator)
        ->not()
        ->toBeNull();
});

it("has an interlocutor", function () {
    $dialog = Dialog::factory()->make();

    expect($dialog->interlocutor)
        ->not()
        ->toBeNull();
});

it("can be blocked", function () {
    $dialog = Dialog::factory()->make();

    expect($dialog->blocked)->toBeFalsy();

    $dialog->block();

    expect($dialog->blocked)->toBeTruthy();
});

it("can be unblocked", function () {
    $dialog = Dialog::factory()->blocked()->make();

    expect($dialog->blocked)->toBeTruthy();

    $dialog->unblock();

    expect($dialog->blocked)->toBeFalsy();
});
