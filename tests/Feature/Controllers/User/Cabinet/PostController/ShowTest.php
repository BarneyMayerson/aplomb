<?php

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it("requires an authentication", function () {
    get(route("cabinet.posts.show", 1))->assertRedirect("/login");
});

it("can show user's post", function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        "user_id" => $user->id,
    ]);

    actingAs($user)
        ->get(route("cabinet.posts.show", $post))
        ->assertComponent("User/Cabinet/Posts/Show");
});

it("passes a post resource to the view", function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        "user_id" => $user->id,
    ]);

    actingAs($user)
        ->get(route("cabinet.posts.show", $post))
        ->assertHasResource("post", PostResource::make($post));
});

it("can't show another user's post", function () {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())
        ->get(route("cabinet.posts.show", $post))
        ->assertForbidden();
});
