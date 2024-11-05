<?php

namespace App\Http\Controllers;

use App\Models\Sender;
use Exception;
use Illuminate\Http\Request;

class SenderController extends Controller
{
    public function getSender(Request $request){
        
        $filter = $request->query->get("filter"); //Gather the filter from the query

        if($filter !=null){ //If there is a filter then search for the asked sender
            $parsed = json_decode($filter, true);
            $sender = $parsed["sender"]; //parsing and getting the query value
            
            if($sender == null){ //If query malformed skip and do normal behaviour
                try{
                    return $this->map(Sender::where("sender", "=", $sender)->get()[0]); //Send back the user with the choosen name
                }
                catch(Exception $exception){
                    return response(null, 404); //If not foudn 404
                }
            }
            
            
        }
        
        //Else if no filter just get all sender and send them back formatted 

        $senders = Sender::all();

        $response = [];

        foreach($senders as $sender){
            $response[] = $this->map($sender);
        }

        return response()->json($response);
    }

    private function map($sender){ //Translate the raw db objects into the api format
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
            return $this->map(Sender::find($id)); //find and send sender with id
        }
        catch(Exception $e){
            return response(null, 404);
        }
        
    }

    public function addSender(Request $request){
        $data = $request->all()["data"];

        return $this->map(Sender::create($data));
    }
}
