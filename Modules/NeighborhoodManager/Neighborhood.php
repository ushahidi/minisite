<?php

namespace Modules\NeighborhoodManager;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Neighborhood extends Model implements Searchable
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'city', 'state', 'country', 'captain_id'];

    /**
     * Get the neighbors for the neighborhood.
     */
    public function neighbors()
    {
        return $this->hasMany('App\User', 'neighborhood_id');
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
       $url = route('neighborhoodShow', $this->id);
    
        return new \Spatie\Searchable\SearchResult(
           $this,
           $this->name,
           $url
        );
    }

}
