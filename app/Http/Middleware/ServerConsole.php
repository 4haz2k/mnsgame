<?php

namespace App\Http\Middleware;

use App\Models\Server;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServerConsole
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->get("server_id", false) and Auth::check())
            if(Server::where("owner_id", Auth::user()->id)->where("id", $request->server_id)->first())
                return $next($request);

        abort(404);
    }
}
