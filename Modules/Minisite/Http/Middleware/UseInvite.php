<?php

namespace Modules\Minisite\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Modules\Minisite\Models\Invite;
use Carbon\Carbon;

class UseInvite
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
        $token = session('invitationToken');
        if ($user && $token){
            Invite::claimBy($user, $token);
            session(['invitationToken' => null ]);
        }
        return $next($request);
    }
}