<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Song;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'username' => 'user',
            'password' => bcrypt('123456')
        ]);

        Song::create([
            'artist' => 'Ed Sheeran',
            'song' => 'Shape of You',
            'duration' => rand(10, 30)
        ]);
        Song::create([
            'artist' => 'Billie Eilish',
            'song' => 'Bad Guy',
            'duration' => rand(10, 30)
        ]);
        Song::create([
            'artist' => 'Post Malone',
            'song' => 'Circles',
            'duration' => rand(10, 30)
        ]);
        Song::create([
            'artist' => 'Taylor Swift',
            'song' => 'Shake It Off',
            'duration' => rand(10, 30)
        ]);
        Song::create([
            'artist' => 'The Weeknd',
            'song' => 'Blinding Lights',
            'duration' => rand(10, 30)
        ]);
        Song::create([
            'artist' => 'Ed Sheeran',
            'song' => 'Photograph',
            'duration' => rand(10, 30)
        ]);
        Song::create([
            'artist' => 'Adele',
            'song' => 'Rolling in the Deep',
            'duration' => rand(10, 30)
        ]);
        Song::create([
            'artist' => 'Post Malone',
            'song' => 'Sunflower',
            'duration' => rand(10, 30)
        ]);
    }
}
