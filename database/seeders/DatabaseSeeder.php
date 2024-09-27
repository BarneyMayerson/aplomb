<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(5)->create();

        Post::factory(8)->withFixture()->recycle($users)->create();

        $racer = User::factory()
            ->has(Post::factory(16)->withFixture())
            ->create([
                'game_username' => 'racer',
                'email' => 'racer@apl.lan',
            ]);
    }
}
