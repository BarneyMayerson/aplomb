<?php

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it("should return the correct component", function () {
    actingAs(User::factory()->create());

    get(route("cabinet.posts.index"))->assertComponent(
        "User/Cabinet/Posts/Index"
    );
});

it("passes posts to the view", function () {
    $user = User::factory()->create();
    $posts = Post::factory(3)->create([
        "user_id" => $user->id,
    ]);

    $posts->load(["user"]);

    actingAs($user)
        ->get(route("cabinet.posts.index"))
        ->assertHasPaginatedResource(
            "posts",
            PostResource::collection($posts->reverse())
        );
});
