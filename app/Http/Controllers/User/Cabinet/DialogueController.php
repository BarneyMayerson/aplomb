<?php

namespace App\Http\Controllers\User\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Resources\Conversation\DialogueResource;
use App\Models\Conversation\Dialogue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DialogueController extends Controller
{
    public function index()
    {
        return Inertia::render("User/Cabinet/Dialogues/Index", [
            "dialogues" => DialogueResource::collection(
                Dialogue::allByUser(Auth::id())
            ),
        ]);
    }

    public function show(Dialogue $dialogue)
    {
        $this->authorize("view", $dialogue);

        return Inertia::render("User/Cabinet/Dialogues/Show", [
            "dialogue" => DialogueResource::make($dialogue),
        ]);
    }

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

        $dialogue->addMessage(
            $request["from"],
            $request["to"],
            $request["message"]
        );
    }
}
