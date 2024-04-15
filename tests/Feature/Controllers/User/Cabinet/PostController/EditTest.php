<?php

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it("requires an authentication", function () {
    get(route("cabinet.posts.show", 1))->assertRedirect("/login");
});

it("can show user edit post page", function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        "user_id" => $user->id,
    ]);

    actingAs($user)
        ->get(route("cabinet.posts.edit", $post))
        ->assertComponent("User/Cabinet/Posts/Edit");
});

it("can't edit another user post", function () {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())
        ->get(route("cabinet.posts.edit", $post))
        ->assertForbidden();
});
