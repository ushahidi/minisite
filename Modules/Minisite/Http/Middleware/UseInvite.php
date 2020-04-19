<?php

namespace Modules\Minisite\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Modules\Minisite\Models\Invite;
use Modules\Minisite\Models\UserCommunity;
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
        $community = $request->route()->community;
        if ($user && session('invitationToken')){
            $invite = Invite::where('token', session('invitationToken'))->first();
            $community_id = null;
            if (isset($invite) && !$invite->claimed && $invite->email === $user->email){
                Invite::where('token', (string) session('invitationToken'))->update(['claimed' => (string) Carbon::now()]);
                //check that they were not already in the community
                UserCommunity::create(['user_id' => $user->id, 'community_id' => $invite->community_id, 'role' => $invite->role]);
                session(['invitationToken' => null ]);
            }
        }    
        return $next($request);
    }
}
