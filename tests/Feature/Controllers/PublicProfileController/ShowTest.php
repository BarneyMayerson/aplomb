<?php

use App\Http\Resources\UserResource;
use App\Models\User;

use function Pest\Laravel\get;

it("returns the public profile component", function () {
    $user = User::factory()->create();

    get(route("public-profile", $user))
        ->assertOk()
        ->assertComponent("PublicProfile");
});

it("passes a user to the view", function () {
    $user = User::factory()->create();

    get(route("public-profile", $user))->assertHasResource(
        "user",
        UserResource::make($user)
    );
});
