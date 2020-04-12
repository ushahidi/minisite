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
        $user = Auth::user();
        $community = $request->route()->community;
        
        if ($community && $user) {
            session(['selectedCommunityName' => $request->route()->community->name]);
            session(['selectedCommunitySlug' => $request->route()->community->slug]);
            session(['selectedCommunityRole' => $user->getRole($community)]);
            
        }
        if (session('selectedCommunityName') && !$user) {
            session(['selectedCommunityName' => null ]);
            session(['selectedCommunitySlug' => null ]);
            session(['selectedCommunityRole' => null ]);
        }
        return $next($request);
    }
}
