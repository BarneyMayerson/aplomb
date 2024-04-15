<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Post::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("User/Cabinet/Posts/Index", [
            "posts" => PostResource::collection(
                Auth()->user()->posts()->latest()->latest("id")->paginate(12)
            ),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("User/Cabinet/Posts/Create");
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
        abort_unless(Auth::id() === $post->user_id, Response::HTTP_FORBIDDEN);

        return Inertia::render("User/Cabinet/Posts/Show", [
            "post" => PostResource::make($post),
        ]);
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
        $data = $request->validate([
            "title" => "required|string|min:2|max:255",
            "body" => "required|string|min:2",
        ]);

        $post->update($data);

        return redirect($post->cabinetShowRoute());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
