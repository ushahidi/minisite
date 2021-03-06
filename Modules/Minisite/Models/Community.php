<?php

namespace Modules\Minisite\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\Minisite\Models\UserCommunity;
use Illuminate\Support\Facades\DB;
class Community extends Model implements Searchable
{
    use Sluggable;
    use SoftDeletes;

    public const TYPE_NEIGHBORHOOD = 'neighborhood';
    public const TYPE_CITY = 'city';
    public const TYPE_STATE = 'state';
    public const TYPE_COUNTRY = 'country';
    public const TYPE_DEPLOYER = 'deployer';
    public const VISIBILITY_COMMUNITY = 'community';
    public const VISIBILITY_PUBLIC = 'public';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'welcome', 'description', 'visibility', 'type', 'location_id', 'deployment_id'];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    /**
     * The attributes that should be mutated to dates.
     * @var array
    */
    protected $dates = ['deleted_at'];

    /**
     * Get the community members for the community.
     */
    public function members()
    {
       return $this->users();
    }

    /**
     * The roles that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_communities')->whereNull('user_communities.deleted_at');
    }


    public function getRole($user) {
        if (!$user) return 'guest';
        return UserCommunity::where(
            [
                ['user_id', '=', $user->id],
                ['community_id', '=', $this->id]
            ]
        )->first()->role ?? 'guest';
    }

    public function containsUser($user) {
        return UserCommunity::where('user_id', $user->id)->where('community_id', $this->id)->first() ?? null;
    }

    public function blocks()
    {
        return $this->hasMany('Modules\Minisite\Models\Block');
    }

    public function communityLocation()
    {
        return $this->belongsTo('Modules\Minisite\Models\CommunityLocation', 'location_id');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('minisite.admin', $this->slug);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }

    public function visibleBy(\App\User $user = null) {
        if ($this->visibility === Community::VISIBILITY_PUBLIC) {
            return true;
        }
        $isCommunityMember = $user && $this->containsUser($user);
        if ($this->visibility === Community::VISIBILITY_COMMUNITY && $isCommunityMember === true) {
            return true;
        }
        return false;
    }
}
