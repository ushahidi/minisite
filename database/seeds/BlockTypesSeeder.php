<?php

use Illuminate\Database\Seeder;
use Modules\BlockManager\BlockType;
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
            'description' => 'Show to the public to explain what we are about',
            'where_is_placed' => 'Appears on top of your community page. Use it to introduce your community to the goals and objectives of your page.',
            'image_url' => 'https://material-components.github.io/material-components-web-catalog/static/media/photos/3x2/2.jpg'
        ])->save();
        BlockType::create([
            'id' => 'Pinned item',
            'description' => 'Pin important information to the top of the page',
            'where_is_placed' => 'Appears after the Page Header, near the top. Use it to alert your community of important events.',
            'image_url' => 'https://material-components.github.io/material-components-web-catalog/static/media/photos/3x2/2.jpg'
        ])->save();
        BlockType::create([
            'id' => 'Ushahidi Platform Map',
            'description' => 'Add a Ushahidi Platform Map ',
            'where_is_placed' => 'Use it to display important information from your Ushahidi Platform deployments, '
                                 . 'such as where to get help, where to buy groceries, or which shops are still doing delivery',
            'image_url' => 'https://4f103e355fd70dee701f-b33c860044c19cda3e23f2a03168f599.ssl.cf2.rackcdn.com/assets/img/grassroots/help-needed.png'
        ])->save();
        
        BlockType::create([
            'id' => 'Featured Youtube Video',
            'description' => 'A video ',
            'where_is_placed' => 'Use it to share important information that matters to your community and is best explained through a video, such as government announcements, tutorials and others.',
            'image_url' => '/img/ushahidiFeaturedVideo.png'
        ])->save();
    }
}
