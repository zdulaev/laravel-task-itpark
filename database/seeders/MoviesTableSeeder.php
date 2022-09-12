<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
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
        // $genre = Genre::find(1)->movies()->get()->toArray();

        $movies = Movie::factory()->count(50)->create();
        foreach ($movies as $movie) {
            $genre_ids = Arr::flatten(Genre::inRandomOrder()->limit(rand(1, 5))->get('id')->toArray());
            $movie_id = $movie->id;

            foreach ($genre_ids as $genre_id) {
                DB::table('movie_genre')->insert([
                    'movie_id' => $movie_id,
                    'genre_id' => $genre_id,
                ]);
            }
            
        }

    }
}
