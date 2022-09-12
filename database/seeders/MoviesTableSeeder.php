<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Models\Movie;
use App\Models\Genre;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // я хочу при создании фильма (App\Models\Movie), привязывать его к жанру (App\Models\Genre)
        // как сделать так, чтобы движок понимал эти связи? 
        // p.s. еще и дебаг через консоль, это пытка. 
        $movies = Movie::factory()->count(1)->create();
        foreach ($movies->genres as $genre) {
            
            // print_r($genre);
        }

    }
}
