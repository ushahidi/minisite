<?php

namespace Modules\BlockManager;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlockTypeFields extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     * @var array
    */
    protected $dates = ['deleted_at'];

    public function blockType()
    {
        return $this->belongsTo('Modules\BlockManager\BlockType', 'block_type');
    }
}
