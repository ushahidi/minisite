<?php

use Illuminate\Database\Seeder;
use App\BlockTypeFields;
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
            'validator' => 'required'
        ])->save();
        BlockTypeFields::create([
            'block_type' => 'Page header',
            'name' => 'Description',
            'validator' => ''
        ])->save();
        
        BlockTypeFields::create([
            'block_type' => 'Pinned item',
            'name' => 'Text',
            'validator' => 'required'
        ])->save();
        BlockTypeFields::create([
            'block_type' => 'Ushahidi Platform Map',
            'name' => 'Url',
            'validator' => 'required'
        ])->save();
    }
}
