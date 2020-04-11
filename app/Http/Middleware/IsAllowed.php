<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\User;
use Modules\BlockManager\Block;
use Modules\BlockManager\BlockTypeFields;
use Modules\CommunityManager\Community;

class IsAllowed
{


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$features
     * @return mixed
     */
    public function handle($request, Closure $next, ...$features)
    {
        $user = Auth::user();
        
        // if (!$community->owner($user)){
        //     abort("401", "You are not authorized to edit this page");
        // }
        // @todo refactor to just grab the role :shrugs: this is bad
        // @todo super gross if I'm an owener in SOME site I'm suddenly an owner in all of them wtf
        $role = 'guest';
        if ($user && $community->owner($user)) {
            $role = 'owner';
        } else if ($user && $community->admin($user)) {
            $role = 'admin';
        } else if ($user && $community->member($user)) {
            $role = 'member';
        }
        return $next($request);
    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
