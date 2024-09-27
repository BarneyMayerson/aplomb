<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;

it('requires authentication', function () {
    delete(route('cabinet.posts.destroy', 1))->assertRedirect(route('login'));
});

it('can delete a post', function () {
    $post = Post::factory()->create();

    actingAs($post->user)->delete(route('cabinet.posts.destroy', $post));

    $this->assertModelMissing($post);
});

it('redirects to the posts index page', function () {
    $post = Post::factory()->create();

    actingAs($post->user)
        ->delete(route('cabinet.posts.destroy', $post))
        ->assertRedirect(route('cabinet.posts.index'));
});

it(
    'redirects to the posts index page with the page query parameter',
    function () {
        $user = User::factory()->create();
        // considering that the default per page is 12
        $posts = Post::factory(14)->create(['user_id' => $user->id]);

        actingAs($user)
            ->delete(
                route('cabinet.posts.destroy', [
                    'post' => $posts->first(),
                    'page' => 2,
                ])
            )
            ->assertRedirect(route('cabinet.posts.index', ['page' => 2]));
    }
);

it(
    'redirects to the posts index page with the proper page query parameter when the last post was deleted on the last page',
    function () {
        $user = User::factory()->create();
        // considering that the default per page is 12
        $posts = Post::factory(25)->create(['user_id' => $user->id]);

        actingAs($user)
            ->delete(
                route('cabinet.posts.destroy', [
                    'post' => $posts->first(),
                    'page' => 3,
                ])
            )
            ->assertRedirect(route('cabinet.posts.index', ['page' => 2]));
    }
);

it('cannot destroy a post from another user', function () {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())
        ->delete(route('cabinet.posts.destroy', $post))
        ->assertForbidden();
});

it('cannot destroy a published post', function () {
    $post = Post::factory()->published()->create();

    actingAs($post->user)
        ->delete(route('cabinet.posts.destroy', $post))
        ->assertSessionHas('flash', [
            'bannerStyle' => 'danger',
            'banner' => 'You cannot delete a published post.',
        ]);
});
