<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required|string|min:2|max:255",
            "body" => "required|string|min:2",
        ]);

        $post = Post::create([...$data, "user_id" => $request->user()->id]);

        return redirect($post->cabinetShowRoute());
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        // $post->load("user");

        // return Inertia::render("Cabinet/Posts/Show", [
        //     "post" => PostResource::make($post),
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
