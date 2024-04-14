<?php

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it("requires authentication", function () {
    get(route("cabinet.posts.create"))->assertRedirect(route("login"));
});

it("returns the correct component", function () {
    actingAs(User::factory()->create())
        ->get(route("cabinet.posts.create"))
        ->assertComponent("User/Cabinet/Posts/Create");
});
