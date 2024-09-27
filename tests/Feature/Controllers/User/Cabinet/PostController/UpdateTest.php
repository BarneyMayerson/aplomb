<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\patch;

it('requires authentication', function () {
    patch(route('cabinet.posts.update', 1))->assertRedirect(route('login'));
});

it('updates the post', function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    $attributes = [
        'title' => 'Updated title',
        'body' => 'Updated body',
    ];

    actingAs($user)->patch(route('cabinet.posts.update', $post), $attributes);

    assertDatabaseHas(Post::class, [...$attributes, 'user_id' => $user->id]);
});

it('redirects to the cabinet post show page', function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        'user_id' => $user->id,
    ]);

    $attributes = [
        'title' => 'Updated title',
        'body' => 'Updated body',
    ];

    actingAs($user)
        ->patch(route('cabinet.posts.update', $post), $attributes)
        ->assertRedirect($post->cabinetShowRoute());
});

it('cannon update a post from another user', function () {
    $post = Post::factory()->create();

    actingAs(User::factory()->create())
        ->patch(route('cabinet.posts.update', $post), [
            'title' => 'New title',
            'body' => 'New body',
        ])
        ->assertForbidden();
});

it('cannot update a published post', function () {
    $post = Post::factory()->published()->create();

    actingAs($post->user)
        ->patch(route('cabinet.posts.update', $post), [
            'title' => 'New title',
            'body' => 'New body',
        ])
        ->assertSessionHas('flash', [
            'bannerStyle' => 'danger',
            'banner' => 'You cannot update a published post.',
        ]);
});

it('requires a valid data', function (array $badData, array|string $errors) {
    $post = Post::factory()->create();

    $validData = [
        'title' => 'Updated title',
        'body' => 'Updated body',
    ];

    actingAs($post->user)
        ->patch(route('cabinet.posts.update', $post), [
            ...$validData,
            ...$badData,
        ])
        ->assertInvalid($errors);
})->with([
    [['title' => null], 'title'],
    [['title' => true], 'title'],
    [['title' => 1], 'title'],
    [['title' => 1.5], 'title'],
    [['title' => str_repeat('a', 256)], 'title'],
    [['title' => str_repeat('a', 1)], 'title'],
    [['body' => null], 'body'],
    [['body' => true], 'body'],
    [['body' => 1], 'body'],
    [['body' => 1.5], 'body'],
    [['body' => str_repeat('a', 1)], 'body'],
]);
