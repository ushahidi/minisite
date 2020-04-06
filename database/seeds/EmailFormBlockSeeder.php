<?php

use Illuminate\Database\Seeder;
use Modules\BlockManager\BlockTypeFields;
use Modules\BlockManager\BlockType;
class EmailFormBlockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlockType::create([
            'id' => 'Email Form',
            'description' => 'An email form so that visitors can send emails from the site.',
            'where_is_placed' => 'Use it to highlight trustworthy news sources, or announcements from authorities that have a RSS feed.',
            'image_url' => '/img/form.png'
        ])->save();
        
        BlockTypeFields::create([
            'block_type' => 'Email Form',
            'name' => 'Recipient',
            'validator' => 'required|email',            
            'html_element' => 'input',
            'html_element_type' => 'text'
        ])->save();
    }
}
