<?php

use Illuminate\Database\Seeder;
use App\BlockType;
class BlockTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlockType::create([
            'id' => 'Page header',
            'description' => 'Show to the public to explain what we are about'
        ])->save();
        BlockType::create([
            'id' => 'Pinned item',
            'description' => 'Pin important information to the top of the page'
        ])->save();
        BlockType::create([
            'id' => 'Ushahidi Platform Map',
            'description' => 'Add a Ushahidi Platform Map '
        ])->save();
        
        BlockType::create([
            'id' => 'Featured Youtube Video',
            'description' => 'A video '
        ])->save();
    }
}
