<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\Conversation\Dialogue;
use Illuminate\Http\Request;

class DialogueController extends Controller
{
    public function store(Request $request): void
    {
        if (empty($request->message)) {
            return;
        }

        $request->validate([
            "from" => "required|numeric|different:to|exists:users,id",
            "to" => "required|numeric|exists:users,id",
            "message" => "required|string|min:2|max:240",
        ]);

        $dialogue = Dialogue::safetyCreate($request["from"], $request["to"]);

        dd($dialogue);
    }
}
