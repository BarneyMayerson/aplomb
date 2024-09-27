<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PublicProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = User::where('game_username', $request->user)->firstOrFail();

        return Inertia::render('PublicProfile', [
            'user' => UserResource::make($user),
        ]);
    }
}
