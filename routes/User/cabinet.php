<?php

use App\Http\Controllers\User\Cabinet\CabinetController;
use App\Http\Controllers\User\Cabinet\DialogueController;
use App\Http\Controllers\User\Cabinet\PostController;
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

        // post
        Route::group(["prefix" => "posts", "as" => "posts."], function () {
            Route::get("", [PostController::class, "index"])->name("index");
            Route::get("create", [PostController::class, "create"])->name(
                "create"
            );
            Route::post("", [PostController::class, "store"])->name("store");
            Route::get("{post}", [PostController::class, "show"])->name("show");
            Route::get("{post}/edit", [PostController::class, "edit"])->name(
                "edit"
            );
            Route::patch("{post}", [PostController::class, "update"])->name(
                "update"
            );
            Route::delete("{post}", [PostController::class, "destroy"])->name(
                "destroy"
            );
            Route::patch("{post}/publish", [
                PostController::class,
                "publish",
            ])->name("publish");
        });
    }
);
