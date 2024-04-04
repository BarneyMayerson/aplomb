<?php

use App\Http\Controllers\User\Cabinet\DialogueController;
use App\Http\Controllers\User\Cabinet\CabinetController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        "middleware" => ["auth"],
        "prefix" => "cabinet",
        "as" => "cabinet.",
    ],
    function () {
        Route::get("", CabinetController::class)->name("index");

        // dialogue
        Route::group(
            [
                "prefix" => "dialogues",
                "as" => "dialogues.",
            ],
            function () {
                Route::get("", [DialogueController::class, "index"])->name(
                    "index"
                );
                Route::get("/{dialogue}", [
                    DialogueController::class,
                    "show",
                ])->name("show");
                Route::post("", [DialogueController::class, "store"])->name(
                    "store"
                );
                Route::post("/{dialogue}", [
                    DialogueController::class,
                    "addMessage",
                ])->name("show.add-message");
            }
        );
    }
);
