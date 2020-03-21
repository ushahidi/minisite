<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Minisite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'neighborhood_id', 'visibility'];
    
    public function neighborhood()
    {
        return $this->belongsTo('App\Neighborhood', 'neighborhood_id');
    }
    public function blocks()
    {
        return $this->hasMany('App\Block');
    }
}
