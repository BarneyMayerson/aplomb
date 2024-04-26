<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\patch;
use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

it("requires authentication", function () {
    patch(route("cabinet.posts.publish", 1))->assertRedirect(route("login"));
});

it("publishes the post", function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        "user_id" => $user->id,
    ]);

    assertFalse($post->isPublished());

    actingAs($user)->patch(route("cabinet.posts.publish", $post));

    assertTrue($post->fresh()->isPublished());
});

it("redirects to the cabinet post show page", function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        "user_id" => $user->id,
    ]);

    actingAs($user)
        ->patch(route("cabinet.posts.publish", $post))
        ->assertRedirect($post->cabinetShowRoute());
});

it("cannon publish a post from another user", function () {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())
        ->patch(route("cabinet.posts.publish", $post))
        ->assertForbidden();
});

it("cannon publish a published post", function () {
    $post = Post::factory()->published()->create();

    actingAs($post->user)
        ->patch(route("cabinet.posts.publish", $post))
        ->assertSessionHas("flash", [
            "bannerStyle" => "danger",
            "banner" => "You cannot publish this post again.",
        ]);
});
