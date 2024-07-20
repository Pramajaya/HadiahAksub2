<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'GenreName' => 'Comedy',
        ]);

        Genre::create([
            'GenreName' => 'Action',
        ]);

        Genre::create([
            'GenreName' => 'Drama',
        ]);

        Genre::create([
            'GenreName' => 'Romance',
        ]);

        Genre::create([
            'GenreName' => 'Horror',
        ]);
    }
}
