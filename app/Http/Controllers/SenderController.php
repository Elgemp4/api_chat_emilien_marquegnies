<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use Exception;
use Illuminate\Http\Request;

class SenderController extends Controller
{
    public function getSender(Request $request){
        
        $filter = $request->query->get("filter");

        if($filter !=null){
            $parsed = json_decode($filter, true);
            $sender = $parsed["sender"];
            
            try{
                return $this->returnFormated(Sender::where("sender", "=", $sender)->get()[0]);
            }
            catch(Exception $exception){
                return response(null, 404);
            }
            
        }


        $senders = Sender::all();

        $response = [];

        foreach($senders as $sender){
            $response[] = $this->returnFormated($sender);
        }

        return response()->json($response);
    }

    private function returnFormated($sender){
        $response_sender = [];
        $response_sender["sender"] = $sender->sender;
        $response_sender["_state"] = $sender->_state;
        $response_sender["_modified"] = $sender->updated_at->valueOf();
        $response_sender["_created"] = $sender->created_at->valueOf();
        $response_sender["_id"] = $sender->id;
        return $response_sender;
    }

    public function getSenderById($id){
        try{
            return $this->returnFormated(Sender::find($id));
        }
        catch(Exception $e){
            return response(null, 404);
        }
        
    }

    public function addSender(Request $request){
        $data = $request->all()["data"];

        return $this->returnFormated(Sender::create($data));
    }
}
