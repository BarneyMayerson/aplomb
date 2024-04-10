<?php

use App\Models\Post;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;
use function Pest\Laravel\withoutExceptionHandling;

beforeEach(function () {
    $this->validData = [
        "title" => "Hello there",
        "body" =>
            "WHAT are you?' said the King, 'or I'll have you executed on the trumpet, and then sat upon it.) 'I'm glad they've begun asking riddles.--I believe I can remember feeling a little of her or of.",
    ];
});

it("requires authentication", function () {
    post(route("cabinet.posts.store"))->assertRedirect(route("login"));
});

it("stores a post", function () {
    /** @var \Tests\TestCase $this */
    $user = User::factory()->create();

    actingAs($user)->post(route("cabinet.posts.store"), $this->validData);

    assertDatabaseHas(Post::class, [
        ...$this->validData,
        "user_id" => $user->id,
    ]);
});

it("redirects to the cabinet post show page", function () {
    withoutExceptionHandling();
    $user = User::factory()->create();

    actingAs($user)
        ->post(route("cabinet.posts.store"), $this->validData)
        ->assertRedirect(Post::latest("id")->first()->cabinetShowRoute());
});

it("requires a valid data", function (array $badData, array|string $errors) {
    actingAs(User::factory()->create())
        ->post(route("cabinet.posts.store"), [...$this->validData, ...$badData])
        ->assertInvalid($errors);
})->with([
    [["title" => null], "title"],
    [["title" => true], "title"],
    [["title" => 1], "title"],
    [["title" => 1.5], "title"],
    [["title" => str_repeat("a", 256)], "title"],
    [["title" => str_repeat("a", 1)], "title"],
    [["body" => null], "body"],
    [["body" => true], "body"],
    [["body" => 1], "body"],
    [["body" => 1.5], "body"],
    [["body" => str_repeat("a", 1)], "body"],
]);
