<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TestingDeleteMembersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'name' => 'I was invited',
            'email' => Str::random(10).'+notowner@gmail.com',
            'password' => Hash::make('password'),
        ]);


        DB::table('users')->insert([
            'name' => 'I am about to be invited',
            'email' => Str::random(10).'+notowner@gmail.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('communities')->insert([
            'name' => Str::random(10),
            'description' => Str::random(10),
            'slug' => 'community-slug',
            'welcome' => Str::random(10),
            'visibility' => 'public',
            'type'  => 'neighborhood',
        ]);

        DB::table('user_communities')->insert([
            'community_id' => 1,
            'user_id' => 1,
            'role' => 'owner'
        ]);

        DB::table('user_communities')->insert([
            'community_id' => 1,
            'user_id' => 2,
            'role' => 'member'
        ]);
    }
}