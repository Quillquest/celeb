<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Ipaddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BlockIpAddressMiddleware
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
        // If the ipaddresses table doesn't exist yet (fresh test DB), skip blocking
        if (! Schema::hasTable('ipaddresses')) {
            return $next($request);
        }

        $ipaddress = DB::table('ipaddresses')->pluck('ipaddress');
        $iparrays = $ipaddress->toArray();
        $userip = $request->ip();
        //dd($userip);
        if (in_array($userip, $iparrays)) {
            abort(403, "You are restricted to access the site.");
        }
        return $next($request);
    }
}
