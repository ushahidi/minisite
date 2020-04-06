<?php

use Illuminate\Database\Seeder;
use Modules\BlockManager\BlockTypeFields;
use Modules\BlockManager\BlockType;

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
            'description' => 'The link to a RSS feed you want to display in your site.',
            'where_is_placed' => 'Use it to highlight trustworthy news sources, or announcements from authorities that have a RSS feed.',
            'image_url' => 'https://upload.wikimedia.org/wikipedia/en/thumb/4/43/Feed-icon.svg/1200px-Feed-icon.svg.png'
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
