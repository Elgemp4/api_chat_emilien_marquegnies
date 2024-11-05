<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use Illuminate\Http\Request;

class SenderController extends Controller
{
    public function getSender(Request $request){
        $senders = Sender::all();

        $response = [];

        foreach($senders as $sender){
            $response_sender = [];
            $response_sender["sender"] = $sender->sender;
            $response_sender["_state"] = $sender->_state;
            $response_sender["_modified"] = $sender->updated_at->valueOf();
            $response_sender["_created"] = $sender->created_at->valueOf();
            $response_sender["_id"] = $sender->id;
            $response[] = $response_sender;
        }

        return response()->json($response);
    }

    public function addSender(Request $request){
        $data = $request->all()["data"];

        Sender::create($data);
    }
}
