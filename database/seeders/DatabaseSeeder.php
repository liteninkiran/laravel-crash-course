<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $baseCount = 10;

        // Create Users
        User::factory($baseCount)->create();

        // Create Posts
        Post::unguard();
        Post::factory($baseCount * 3)->create();
        Post::reguard();

        // Create Likes
        Like::factory(3)->create();
    }
}
