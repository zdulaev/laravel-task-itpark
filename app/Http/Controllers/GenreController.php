<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Genre::all();

        return view('genres', ['data' => $data]);
    }

    /**
     * Create the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $genre = new Genre;
        $genre->name = $request->input('name');

        $genre->save();

        return redirect()->route('genre-update', $genre->id)->with('success', 'Создал');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $genre = Genre::find($id);
        $genre->name = $request->input('name');

        $genre->save();
        return redirect()->route('genre-store', $id)->with('success', 'Обновил');
    }

    /**
     * Show the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = Genre::find($id);

        if (!isset($data)) {
            return view('errors.500');
        }

        return view('genre-update', ['data' => $data]);
    }

    /**
     * Add the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('genre-add');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Genre::find($id);
        $return = redirect()->route('genres');

        if (isset($data)) {
            $data->delete();
            $return->with('success', 'Удалил');
        } else {
            $return->withErrors(['msg' => 'Ошибка']);
        }

        return $return;
    }
}
