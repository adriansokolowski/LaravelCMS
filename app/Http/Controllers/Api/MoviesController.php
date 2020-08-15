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
        $sortBy = request('sortBy', 'created_at');
        
        if(!in_array($sortBy, ['created_at', 'last_view', 'views'])){
            $sortBy = 'created_at';
        }
        return MovieResource::collection(
            Movie::take(20)->orderBy($sortBy, 'desc')->get()
        );
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
