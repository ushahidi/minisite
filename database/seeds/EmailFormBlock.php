<?php

use Illuminate\Database\Seeder;
use App\BlockTypeFields;
use App\BlockType;
class EmailFormBlock extends Seeder
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
            'description' => 'An email form so that visitors can send emails from the site.'
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
