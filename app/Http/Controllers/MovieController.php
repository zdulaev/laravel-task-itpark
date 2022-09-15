<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use App\Models\Movie;
use App\Models\Genre;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Movie::with('genres')->where('published', true)->paginate(10);

        return view('movies', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image',
            'genres' => 'required'
        ]);

        $movie = Movie::find($id);
        $movie->name = $request->input('name');
        if ($request->has('genres')) {
            $excess_genres = $movie->genres->keyBy('id')->keys()->diff(
                collect(array_keys($request->input('genres')))
            );

            foreach ($excess_genres as $genre) {
                DB::table('movie_genre')->where([
                    ['movie_id', '=', $id],
                    ['genre_id', '=', $genre],
                ])->delete();
            }

            foreach ($request->input('genres') as $genre_key => $genre) {
                $genres[] = [
                    'movie_id' => $id,
                    'genre_id' => $genre_key,
                ];
            }
            DB::table('movie_genre')->insertOrIgnore($genres);
        }

        if (isset($request['image'])) {
            $filename = $request['image']->getClientOriginalName();
            
            $request['image']->move(Storage::path('public/images/news/') . 'origin/', $filename);
            
            $thumbnail = Image::make(Storage::path('public/images/news/') . 'origin/' . $filename);
            $thumbnail->fit(300, 300);
            $thumbnail->save(Storage::path('public/images/news/') . 'thumbnail/' . $filename);
            
            $movie->img = $filename;
        } else {

            // default
            $movie->img = '../default-movie.png';
        }

        $movie->save();
        return redirect()->route('movie-store', $id)->with('success', 'Обновил');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Movie::with('genres')->where('published', true)->find($id);

        if (!isset($data)) {
            return view('errors.404');
        }

        return view('movie', ['data' => $data]);
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = Movie::with('genres')->where('published', true)->find($id);

        if (!isset($data)) {
            return view('errors.500');
        }

        $genres = Genre::all()->diff($data->genres);

        return view('movie-update', ['data' => $data, 'genres' => $genres]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Movie::find($id);
        $return = redirect()->route('movies');

        if (isset($data)) {
            $data->delete();
            $return->with('success', 'Удалил');
        } else {
            $return->withErrors(['msg' => 'Ошибка']);
        }

        return $return;
    }
}
