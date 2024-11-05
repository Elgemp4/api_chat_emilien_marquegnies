<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Exception;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessages(Request $request){
        $filter = $request->query->get("filter");

        if($filter !=null){
            $parsed = json_decode($filter, true);

            $sender_id = $parsed["sender._id"];
            
            if($sender_id != null){
                try{
                    $messages = Message::where("sender_id", "=", $sender_id)->get();
                    return response()->json($this->map_all($messages));
                }
                catch(Exception $exception){
                    return response(null, 404);
                }
            }   
        }

        $allMessages = Message::all();

        return response()->json($this->map_all($allMessages));
    }

    public function sendMessage(Request $request){
        $data = $request["data"];

        $message = [
            "sender_id" => $data["sender"]["_id"],
            "content" => $data["message"],
            "_state" => $data["_state"]
        ];

        try{
            return $this->map(Message::create($message));
        }
        catch(Exception $e){
            return response(null, 400); //Si user id est mauvais
        }
    }

    private function map_all($raw_responses){
        $reponse = [];
        foreach($raw_responses as $message) {
            $reponse[] = $this->map($message);
        }

        return $reponse;
    }

    private function map($raw_response){
        $response = [
            "sender" => [
                "_model" => "senders",
                "_id" => $raw_response->sender_id
            ],
            "message" => $raw_response->content,
            "_state" => $raw_response->_state,
            "_modified" => $raw_response->updated_at->valueOf(),
            "_created" => $raw_response->created_at->valueOf(),
            "_id" => $raw_response->id
        ];

        return $response;
    }
}
