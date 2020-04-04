<?php

use Illuminate\Database\Seeder;
use Modules\BlockManager\BlockTypeFields;
use Modules\BlockManager\BlockType;
class WhatsappGroupBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlockType::create([
            'id' => 'WhatsApp Group Link',
            'description' => 'A direct link to join your site\'s WhatsApp group.'
        ])->save();
        
        BlockTypeFields::create([
            'block_type' => 'WhatsApp Group Link',
            'name' => 'Url',
            'validator' => 'required',            
            'html_element' => 'input',
            'html_element_type' => 'text'
        ])->save();
        
        BlockTypeFields::create([
            'block_type' => 'WhatsApp Group Link',
            'name' => 'Info',
            'validator' => '',            
            'html_element' => 'input',
            'html_element_type' => 'text'
        ])->save();
    }
}
