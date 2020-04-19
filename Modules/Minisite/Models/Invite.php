<?php

namespace Modules\Minisite\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use Modules\Minisite\Models\Invite;
use Modules\Minisite\Models\Community;
use Modules\Minisite\Models\UserCommunity;
use Carbon\Carbon;

class Invite extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     * @var array
    */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['generated_by', 'token', 'community_id', 'role', 'email', 'claimed'];
    public static function claimBy(User $user, string $token) {
        $invite = Invite::where('token', $token)->first();
        $user_community = null;
        if (isset($invite) && !$invite->claimed && $invite->email === $user->email){
            $user_community = UserCommunity::where('user_id', $user->id)->where('community_id', $invite->community_id)->first();
            Invite::where('token', (string) $token)->update(['claimed' => (string) Carbon::now()]);
            if (!$user_community){
                //check that they were not already in the community
                $user_community = UserCommunity::create(['user_id' => $user->id, 'community_id' => $invite->community_id, 'role' => $invite->role]);
            }
        }
        return $user_community;
    }
} 
