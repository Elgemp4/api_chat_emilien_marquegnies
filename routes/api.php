<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\SenderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get("/content/item/messages", [MessageController::class, "getMessages"]);
Route::post("/content/item/messages", [MessageController::class, "sendMessage"]);

Route::get("/content/item/senders", [SenderController::class, "getSender"]);
Route::post("/content/item/senders", [SenderController::class, "addSender"]);