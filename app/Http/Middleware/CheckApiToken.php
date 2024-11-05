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
        $api_key = $request->headers->get("api-key");

        $token = file_get_contents(storage_path("../api-key.txt"));
        
        if($api_key != $token){
            return response()->json(["error" => "Permission denied"], 403);
        }

        return $next($request);
    }
}
