<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessages(Request $request){
        $allMessages = Message::all();
        dd($allMessages);
        $response = [];

        foreach ($allMessages as $message) {
            dd($message);
        }
    }

    public function sendMessage(Request $request){
        
    }
}
