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
        $movie = new Movie(request(['title', 'description', 'fdb', 'year', 'rate', 'view']));
        $movie->save();
        //$image = $request['poster'];
        //$request->poster->storeAs('poster', $movie->id . '.jpg', 'public');
        $movie->categories()->attach(request('categories'));

        return $movie->path();
    }
}
