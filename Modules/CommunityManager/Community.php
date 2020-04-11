<?php

namespace Modules\CommunityManager;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Modules\CommunityManager\UserCommunity;
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
    public function communityMembers()
    {
       return $this->users();
    }

    
    /**
     * The roles that belong to the user.
     */
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_communities');
    }
    
    public function member($user) {
        return DB::table('user_communities')->where(
            [
                ['user_id', '=', $user->id],
                ['community_id', '=', $this->id],
                ['role', '=', UserCommunity::ROLE_MEMBER]
            ]
        )->get() ?? null;            
    }

    public function admin($user) {
        return DB::table('user_communities')->where(
            [
                ['user_id', '=', $user->id],
                ['community_id', '=', $this->id],
                ['role', '=', UserCommunity::ROLE_ADMIN]
            ]
        )->get() ?? null;            
    }

    public function owner($user) {
        return DB::table('user_communities')->where(
            [
                ['user_id', '=', $user->id],
                ['community_id', '=', $this->id],
                ['role', '=', UserCommunity::ROLE_OWNER]
            ]
        )->get() ?? null;            
    }

    public function containsUser($user) {
        return UserCommunity::where('user_id', $user->id)->where('community_id', $this->id)->get() ?? null;
    }

    // //@change
    // public function captain()
    // {
    //     return $this->belongsTo('App\User', 'captain_id');
    // }

    // public function getSearchResult(): SearchResult
    // {
    //    $url = route('communityShow', $this->id);
    
    //     return new \Spatie\Searchable\SearchResult(
    //        $this,
    //        $this->name,
    //        $url
    //     );
    // }

    public function blocks()
    {
        return $this->hasMany('Modules\BlockManager\Block');
    }

    public function communityLocation()
    {
        return $this->belongsTo('Modules\CommunityManager\CommunityLocation', 'location_id');
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
