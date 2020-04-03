<?php

use Illuminate\Database\Seeder;
use Modules\BlockManager\BlockTypeFields;
use Modules\BlockType;

class FreeFormBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlockType::create([
            'id' => 'Free form',
            'description' => 'Add content that doesn\'t fit other block types.'
        ])->save();
        
        BlockTypeFields::create([
            'block_type' => 'Free form',
            'name' => 'Content',
            'validator' => 'required',            
            'html_element' => 'textarea',
            'html_element_type' => ''
        ])->save();
    }
}
