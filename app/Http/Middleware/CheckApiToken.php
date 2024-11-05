<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $api_key = $request->headers->get("api-key"); //Getting the api-key from the corresponding header

        $token = file_get_contents(storage_path("../api-key.txt")); //Getting the key from the text file
        
        if($api_key != $token){ //If incorrect stop here
            return response()->json(["error" => "Permission denied"], 403); 
        }

        return $next($request); //If api key correcty continuie
    }
}
