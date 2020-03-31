<?php

use Illuminate\Database\Seeder;
use App\BlockTypeFields;
use App\BlockType;

class RSSFeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlockType::create([
            'id' => 'RSS Feed',
            'description' => 'The link to a RSS feed you want to display in your site.'
        ])->save();
        
        BlockTypeFields::create([
            'block_type' => 'RSS Feed',
            'name' => 'Url',
            'validator' => 'required',            
            'html_element' => 'input',
            'html_element_type' => 'text'
        ])->save();
        BlockTypeFields::create([
            'block_type' => 'RSS Feed',
            'name' => 'Limit',
            'validator' => 'required',            
            'html_element' => 'input',
            'html_element_type' => 'text'
        ])->save();
        BlockTypeFields::create([
            'block_type' => 'RSS Feed',
            'name' => 'Description',
            'validator' => '',            
            'html_element' => 'textarea',
            'html_element_type' => ''
        ])->save();
    }
}
