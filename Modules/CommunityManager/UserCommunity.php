<?php

namespace Modules\CommunityManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCommunity extends Model
{    
    
    use SoftDeletes;

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
}
