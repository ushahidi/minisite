<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Minisite extends Model implements Searchable
{
    
    use Sluggable;

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
    protected $fillable = ['title', 'neighborhood_id', 'visibility', 'slug'];
    
    public function neighborhood()
    {
        return $this->belongsTo('App\Neighborhood', 'neighborhood_id');
    }
    public function blocks()
    {
        return $this->hasMany('App\Block');
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
    
    public function visibleBy(User $user = null) {
        if ($this->visibility === 'public') {
            return true;
        }
        $isNeighbor = $user && $user->neighborhood_id && $user->neighborhood_id === $this->neighborhood_id;
        if ($this->visibility === 'neighbors' && $isNeighbor === true) {
            return true;
        }
        return false;
    }
}
