<?php

namespace App\Http\Middleware;

use App\ClientApiLog;
use Closure;
use \Illuminate\Http\Request;

class LogApiRequestsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $log = new ClientApiLog();
        $log->user_id=$request->user()->id;
        $log->route =$request->route()->getName();
        $log->request = json_encode($request->all());
        $log->save();
        return $next($request);
    }
}
