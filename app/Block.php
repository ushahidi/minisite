<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = ['minisite_id', 'name', 'description', 'type', 'visibility', 'position', 'enabled'];

    public function neighborhood()
    {
        return $this->belongsTo('App\Minisite', 'block_id');
    }
}
