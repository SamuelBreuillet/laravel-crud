<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)
            ->has(Post::factory()->count(20))
            ->create();

        User::factory()->create([
            'name' => 'AFUP Nantes',
            'email' => 'afup-nantes@laravel.io',
            'is_admin' => true,
        ]);
    }
}
