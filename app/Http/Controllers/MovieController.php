<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Genre;

class MovieController extends Controller
{
    /**
     * Показать список ресурсов.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Movie::with('genres')->where('published', true)->paginate(10);

        return view('movies.index', ['data' => $data]);
    }

    /**
     * Обновить указанный ресурс в хранилище.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image',
            'genres' => 'array'
        ]);
        $movie = Movie::find($id);
        $movie->name = $request->input('name');
        $movie->genres()->sync(array_keys((array)$request->input('genres')));

        $movie->img = set_images($request['image']);
        $movie->save();
        return redirect()->route('movies.show', $id)->with('success', 'Обновил');
    }

    /**
     * Показать указанный ресурс.
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

        return view('movies.show', ['data' => $data]);
    }

    /**
     * Показать форму для создания нового ресурса.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();

        return view('movies.create', ['genres' => $genres]);
    }

    /**
     * Сохранить вновь созданный ресурс в хранилище.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image',
            'genres' => 'array'
        ]);

        $movie = new Movie;
        $movie->name = $request->input('name');
        $movie->published = true;

        $movie->img = set_images($request['image']);
        $movie->save();

        if ($request->has('genres')) {
            $movie->genres()->attach(array_keys($request->input('genres')));
        }
        return redirect()->route('movies.show', $movie->id)->with('success', 'Создал');
    }

    /**
     * Показать форму редактирования указанного ресурса.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Movie::with('genres')->where('published', true)->find($id);

        if (!isset($data)) {
            return view('errors.500');
        }

        $genres = Genre::all()->diff($data->genres);

        return view('movies.edit', ['data' => $data, 'genres' => $genres]);
    }

    /**
     * Удалить указанный ресурс из хранилища.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Movie::find($id);
        $return = redirect()->route('movies.index');

        if (isset($data)) {
            $data->delete();
            $return->with('success', 'Удалил');
        } else {
            $return->withErrors(['msg' => 'Ошибка']);
        }

        return $return;
    }
}
