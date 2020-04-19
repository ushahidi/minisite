<?php

namespace Modules\CommunityManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class UserCommunity extends Model
{    
    
    use SoftDeletes;
    public $incrementing = false;
    // we will probably do permissions based later on but that's ok since it's easy to migrate
    public const ROLE_OWNER = 'owner';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_MEMBER = 'member';

    protected $fillable = ['community_id', 'user_id', 'role'];

    /**
     * The attributes that should be mutated to dates.
     * @var array
    */
    protected $dates = ['deleted_at'];
    protected function setKeysForSaveQuery(Builder $query)
    {
        $query->where('user_id', '=', $this->user_id)->where('community_id', '=', $this->community_id);
        return $query;
    }
}
