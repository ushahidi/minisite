<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlockTypeFields extends Model
{

    public function blockType()
    {
        return $this->belongsTo('App\BlockType', 'block_type');
    }
}
