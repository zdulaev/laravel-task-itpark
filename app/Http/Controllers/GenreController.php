<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    /**
     * Показать список ресурсов.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Genre::all();

        return view('genres.index', ['data' => $data]);
    }

    /**
     * Показать форму для создания нового ресурса.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('genres.create');
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
        ]);

        $genre = new Genre;
        $genre->name = $request->input('name');

        $genre->save();
        return redirect()->route('genres.edit', $genre->id)->with('success', 'Создал');
    }

    /**
     * Обновить указанный ресурс в хранилище.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $genre = Genre::find($id);
        $genre->name = $request->input('name');

        $genre->save();
        return redirect()->route('genres.edit', $id)->with('success', 'Обновил');
    }

    /**
     * Показать форму редактирования указанного ресурса.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Genre::find($id);

        if (!isset($data)) {
            return view('errors.500');
        }

        return view('genres.edit', ['data' => $data]);
    }

    /**
     * Удалить указанный ресурс из хранилища.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Genre::find($id);
        $return = redirect()->route('genres.index');

        if (isset($data)) {
            $data->delete();
            $return->with('success', 'Удалил');
        } else {
            $return->withErrors(['msg' => 'Ошибка']);
        }

        return $return;
    }
}
