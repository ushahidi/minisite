<?php

namespace Modules\CommunityManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityLocation extends Model
{    
    
    use SoftDeletes;

    // we will probably do permissions based later on but that's ok since it's easy to migrate
    public const SOURCE_MANUAL = 'manual_entry';
    public const SOURCE_USER_OSM = 'user_osm_entry'; //user entry, with OSM

    protected $fillable = ['location_source', 'city', 'state', 'country', 'location_info'];

    protected $casts = [
        'location_info' => 'object'
    ];
    /**
     * The attributes that should be mutated to dates.
     * @var array
    */
    protected $dates = ['deleted_at'];

    
    public function community()
    {
        return $this->hasOne('Modules\CommunityManager\Community', 'community_id');
    }
    
}
