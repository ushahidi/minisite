<?php

namespace Modules\Minisite\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlockType extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id'; // or null

    public $incrementing = false;

    /**
     * The attributes that should be mutated to dates.
     * @var array
    */
    protected $dates = ['deleted_at'];

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected function fields() {
        return $this->hasMany('Modules\Minisite\Models\BlockTypeFields', 'block_type', 'id');
    }
}
