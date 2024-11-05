<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\SenderController;
use App\Http\Middleware\CheckApiToken;
use Illuminate\Support\Facades\Route;

Route::get("/", function() {
    return response()->json((["message" => "This is an api to manage messages and senders, here are the differents routes : /content/item/messages /content/item/senders"]));
});

Route::get("/content/item/messages", [MessageController::class, "getMessages"]);
Route::middleware(CheckApiToken::class)->post("/content/item/messages", [MessageController::class, "sendMessage"]);

Route::get("/content/item/senders", [SenderController::class, "getSender"]);
Route::get("/content/item/senders/{id}", [SenderController::class, "getSenderById"]);


Route::middleware(CheckApiToken::class)->post("/content/item/senders", [SenderController::class, "addSender"]);