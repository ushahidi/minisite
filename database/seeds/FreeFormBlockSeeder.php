<?php

use Illuminate\Database\Seeder;
use Modules\Minisite\Models\BlockTypeFields;
use Modules\Minisite\Models\BlockType;

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
            'description' => 'Add content that doesn\'t fit other block types.',
            'where_is_placed' => 'Use it to write down other information that you want to share with your community, with some formatting options.',
            'image_url' => '/img/tipTap.png'
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
