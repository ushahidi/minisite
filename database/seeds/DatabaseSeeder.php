<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BlockTypeSeeder::class);
        $this->call(BlockTypeFieldsSeeder::class);
        $this->call(WhatsappGroupBlockSeeder::class);
        $this->call(EmailFormBlockSeeder::class);
        $this->call(FreeFormBlockSeeder::class);
        $this->call(RSSFeedSeeder::class);

    }
}
