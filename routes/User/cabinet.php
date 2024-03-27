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
                "prefix" => "dialogue",
                "as" => "dialogue.",
            ],
            function () {
                Route::post("", [DialogueController::class, "store"])->name(
                    "store"
                );
            }
        );
    }
);
