<?php

namespace Modules\Minisite;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use App\User;

class Minisite extends Model implements Searchable
{
    use Sluggable;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
    */
    protected $dates = ['deleted_at'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'community_id', 'visibility', 'slug'];
    
    public function community()
    {
        return $this->belongsTo('Modules\CommunityManager\Community', 'community_id');
    }

    public function blocks()
    {
        return $this->hasMany('Modules\BlockManager\Block');
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
        $url = route('minisitePublic', $this->slug);

        return new SearchResult(
            $this,
            $this->title,
            $url
        );
    }

    public function visibleBy(\App\User $user = null) {
        if ($this->visibility === 'public') {
            return true;
        }
        $isCommunityMember = $user && $user->community_id && $user->community_id === $this->community_id;
        if ($this->visibility === 'community members' && $isCommunityMember === true) {
            return true;
        }
        return false;
    }
}
