<?php

use Illuminate\Database\Seeder;
use Modules\Minisite\Models\BlockTypeFields;
class BlockTypeFieldsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlockTypeFields::create([
            'block_type' => 'Page header',
            'name' => 'Title',
            'validator' => 'required',
            'html_element' => 'input',
            'html_element_type' => 'text'
        ])->save();
        BlockTypeFields::create([
            'block_type' => 'Page header',
            'name' => 'Description',
            'validator' => '',        
            'html_element' => 'textarea',
            'html_element_type' => null
        ])->save();
        
        BlockTypeFields::create([
            'block_type' => 'Pinned item',
            'name' => 'Text',
            'validator' => 'required',        
            'html_element' => 'input',
            'html_element_type' => 'text'
        ])->save();
        BlockTypeFields::create([
            'block_type' => 'Pinned item',
            'name' => 'Info',
            'validator' => '',        
            'html_element' => 'textarea',
            'html_element_type' => null
        ])->save();
        BlockTypeFields::create([
            'block_type' => 'Ushahidi Platform Map',
            'name' => 'Url',
            'validator' => 'required',            
            'html_element' => 'input',
            'html_element_type' => 'text'
        ])->save();
        BlockTypeFields::create([
            'block_type' => 'Featured Youtube Video',
            'name' => 'Url',
            'validator' => 'required',            
            'html_element' => 'input',
            'html_element_type' => 'text'
        ])->save();
    }
}
