<?php

use App\Models\User;

test("profile information can be updated", function () {
    $this->actingAs($user = User::factory()->create());

    $response = $this->put("/user/profile-information", [
        "game_username" => "tester",
        "name" => "Test Name",
        "email" => "test@example.com",
    ]);

    expect($user->fresh())
        ->game_username->toEqual("tester")
        ->name->toEqual("Test Name")
        ->email->toEqual("test@example.com");
});
