<?php

namespace Modules\CommunityManager;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model implements Searchable
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'city', 'state', 'country', 'captain_id'];

    /**
     * The attributes that should be mutated to dates.
     * @var array
    */
    protected $dates = ['deleted_at'];

    /**
     * Get the community members for the community.
     */
    public function community members()
    {
        return $this->hasMany('App\User', 'community_id');
    }

    public function captain()
    {
        return $this->belongsTo('App\User', 'captain_id');
    }

    public function minisite()
    {
        return $this->hasOne('Modules\Minisite\Minisite');
    }

    public function getSearchResult(): SearchResult
    {
       $url = route('communityShow', $this->id);
    
        return new \Spatie\Searchable\SearchResult(
           $this,
           $this->name,
           $url
        );
    }

}
