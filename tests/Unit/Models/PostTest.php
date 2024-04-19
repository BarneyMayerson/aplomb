<?php

use App\Models\Post;

it("generates the html", function () {
    $post = Post::factory()->make([
        "body" => "## Hello there!",
    ]);

    $post->save();

    expect($post->html)->toEqual(str($post->body)->markdown());
});
