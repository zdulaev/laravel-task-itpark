<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        if (!isset($data)) {
            return response()->json([], 204);
        }
        return response()->json(['data' => $data], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Genre::find($id);

        if (!isset($data)) {
            return response()->json([], 204);
        }
        $data = $data->movies()->paginate(10);

        return response()->json($data, 200);
    }

}
