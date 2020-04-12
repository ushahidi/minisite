<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;

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
        if ($request->route()->community && Auth::user()) {
            session(['selectedCommunityName' => $request->route()->community->name]);
            session(['selectedCommunitySlug' => $request->route()->community->slug]);
        }
        if (session('selectedCommunityName') && !Auth::user()) {
            session(['selectedCommunityName' => null ]);
            session(['selectedCommunitySlug' => null ]);
        }
        return $next($request);
    }
}
