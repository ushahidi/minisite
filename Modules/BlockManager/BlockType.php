<?php

namespace Modules\BlockManager;

use Illuminate\Database\Eloquent\Model;

class BlockType extends Model
{
    protected $primaryKey = 'id'; // or null

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';

    protected function fields() {
        return $this->hasMany('Modules\BlockManager\BlockTypeFields', 'block_type', 'id');
    }
}
