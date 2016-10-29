<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class AfterDBQueryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        $response = $next($request);
         
        $content_response = $response->getOriginalContent();

        //retrieve all executed queries
        $queries = DB::getQueryLog();

        dd($queries);
     
        //code to save query logs in a file
        
        $content_response = $content_response . "<br/>----------------<br/>" . print_r($queries);

        $response->setContent($content_response);

        //return response
        return $response;   
    }
}
