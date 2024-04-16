<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;

it("requires authentication", function () {
    delete(route("cabinet.posts.destroy", 1))->assertRedirect(route("login"));
});

it("can delete a post", function () {
    $post = Post::factory()->create();

    actingAs($post->user)->delete(route("cabinet.posts.destroy", $post));

    $this->assertModelMissing($post);
});

it("redirects to the posts index page", function () {
    $post = Post::factory()->create();

    actingAs($post->user)
        ->delete(route("cabinet.posts.destroy", $post))
        ->assertRedirect(route("cabinet.posts.index"));
});

it(
    "redirects to the posts index page with the page query parameter",
    function () {
        $post = Post::factory()->create();

        actingAs($post->user)
            ->delete(
                route("cabinet.posts.destroy", ["post" => $post, "page" => 2])
            )
            ->assertRedirect(route("cabinet.posts.index", ["page" => 2]));
    }
);

it("cannon destroy a post from another user", function () {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())
        ->delete(route("cabinet.posts.destroy", $post))
        ->assertForbidden();
});
