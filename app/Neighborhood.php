<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
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
        return $this->hasOne('App\Minisite');
    }

}
