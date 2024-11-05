<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\SenderController;
use App\Http\Middleware\CheckApiToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("/content/item/messages", [MessageController::class, "getMessages"]);
Route::middleware(CheckApiToken::class)->post("/content/item/messages", [MessageController::class, "sendMessage"]);

Route::get("/content/item/senders", [SenderController::class, "getSender"]);
Route::get("/content/item/senders/{id}", [SenderController::class, "getSenderById"]);


Route::middleware(CheckApiToken::class)->post("/content/item/senders", [SenderController::class, "addSender"]);