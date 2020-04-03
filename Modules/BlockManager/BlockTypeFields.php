<?php

namespace Modules\BlockManager;

use Illuminate\Database\Eloquent\Model;

class BlockTypeFields extends Model
{
    public function blockType()
    {
        return $this->belongsTo('Modules\BlockManager\BlockType', 'block_type');
    }
}
