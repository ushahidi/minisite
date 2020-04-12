<?php

namespace App\Http\Middleware;

use Closure;

class SetCurrentCommunity
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
        if ($request->route()->community) {
            session(['selectedCommunityName' => $request->route()->community->name]);
            session(['selectedCommunitySlug' => $request->route()->community->slug]);
        }
        return $next($request);
    }
}
