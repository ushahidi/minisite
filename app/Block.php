<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{    
    
    protected $casts = [
        'content' => 'object'
    ];
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['minisite_id', 'name', 'description', 'type', 'visibility', 'position', 'enabled', 'content'];


    public function minisite()
    {
        return $this->belongsTo('App\Minisite', 'minisite_id');
    }
    
    public function visibleBy(User $user = null) {
        if ($this->visibility === 'public') {
            return true;
        }
        $isNeighbor = $user && $user->neighborhood_id && $user->neighborhood_id === $this->minisite->neighborhood_id;
        if ($this->visibility === 'neighbors' && $isNeighbor === true) {
            return true;
        }
        return false;
    }
}
