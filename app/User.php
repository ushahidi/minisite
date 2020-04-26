<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Minisite\Models\Community;
use Modules\Minisite\Models\UserCommunity;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'community_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The attributes that should be mutated to dates.
     * @var array
    */
    protected $dates = ['deleted_at'];

    public function communities()
    {
        return $this->belongsToMany('Modules\Minisite\Models\Community', 'user_communities');
    }
    public function getRole(Community $community)
    {
        return UserCommunity::where(['user_id' => $this->id, 'community_id' => $community->id])->first()->role ?? '';
    }
    
    public function getCommunityRelation(Community $community)
    {
        return UserCommunity::where(['user_id' => $this->id, 'community_id' => $community->id])->first();
    }
}
