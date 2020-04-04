<?php

namespace Modules\BlockManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this->belongsTo('Modules\CommunityManager\Community', 'community_id');
    }
    
    public function visibleBy(User $user = null) {
        if ($this->visibility === 'public') {
            return true;
        }
        $isCommunityMember = $user && $user->community_id && $user->community_id === $this->minisite->community_id;
        if ($this->visibility === 'community members' && $isCommunityMember === true) {
            return true;
        }
        return false;
    }
}
