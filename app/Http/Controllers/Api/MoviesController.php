<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMovie;
use App\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function store(CreateMovie $request)
    {
        $request->validated();
        $movie = new Movie(request(['title', 'desc', 'year', 'fdb', 'rate', 'view']));
        $movie->save();
        //request()->thumb->storeAs('poster', $movie->id . '.jpg', 'public');
        //$movie->categories()->attach(request('categories'));

        //return $movie;
    }
}
