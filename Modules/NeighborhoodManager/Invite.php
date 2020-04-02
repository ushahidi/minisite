<?php

namespace Modules\NeighborhoodManager;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['generated_by', 'token', 'neighborhood_id'];
}
