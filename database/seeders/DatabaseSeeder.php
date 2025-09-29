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

        User::factory()
            ->has(Post::factory()->count(2))
            ->inactive()
            ->create([
                'email' => 'inactive@example.com',
            ]);

        User::factory()->create([
            'name' => 'AFUP Nantes',
            'email' => 'afup-nantes@laravel.io',
            'is_admin' => true,
        ]);



        User::factory()
            ->has(
                Post::factory()
                    ->state(function (array $attributes, User $user) {
                        return ['id' => 999];
                    })
            )
            ->create([
                'email' => 'test@laravel.io'
            ]);
    }
}
