<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;

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

        if (!isset($data)) {
            return response()->json([], 204);
        }
        return response()->json($data, 200);
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
            return response()->json([], 204);
        }
        return response()->json($data, 200);
    }
}
