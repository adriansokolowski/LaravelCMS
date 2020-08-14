<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Resources\MovieResource;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MoviesController extends Controller
{
    public function index()
    {
        return MovieResource::collection(Movie::all());
    }

    public function store(StoreMovieRequest $request)
    {
        $movie = new Movie($request->validated());
        $movie->html = '';
        $movie->last_view = now();
        $movie->save();
        $contents = file_get_contents($request->poster);
        Storage::disk("public")->put('/poster/' . $movie->id . '.jpg', $contents);
        $movie->categories()->attach($request->categories);

        return $movie->path();
    }
}
