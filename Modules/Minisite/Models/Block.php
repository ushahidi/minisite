<?php

namespace Modules\Minisite\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Minisite\Models\Community;
use App\User;

class Block extends Model
{
    use SoftDeletes;

    protected $casts = [
        'content' => 'object'
    ];

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
    protected $fillable = ['community_id', 'name', 'description', 'type', 'visibility', 'position', 'enabled', 'content'];


    public function minisite()
    {
        return $this->belongsTo('Community', 'community_id');
    }

    public function visibleBy(User $user = null, Community $community = null) {
        if ($this->visibility === 'public') {
            return true;
        }
        $isCommunityMember = $user && $community->containsUser($user);
        if ($this->visibility === 'community' && $isCommunityMember === true) {
            return true;
        }
        return false;
    }
}
