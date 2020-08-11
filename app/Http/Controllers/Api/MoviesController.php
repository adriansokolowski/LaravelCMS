<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMovie;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    public function store(CreateMovie $request)
    {
        $request->validated();
        $movie = new Movie(request(['title', 'user_id', 'description', 'fdb', 'release_date', 'imdb_rate', 'view']));
        $movie->up = 0;
        $movie->down = 0;
        $movie->last_view = now();
        $movie->save();
        //$request->poster->storeAs('poster', $movie->id . '.jpg', 'public');

        $contents = file_get_contents($request['poster']);
        Storage::disk("public")->put('/poster/' . $movie->id . '.jpg', $contents);

        $movie->categories()->attach(request('categories'));

        return $movie->path();
    }
}
