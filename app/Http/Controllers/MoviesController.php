<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\CreateMovie;
use App\Http\Requests\EditMovie;

use App\Movie;
use App\Category;
use App\Serie;
use App\Link;

class MoviesController extends Controller
{
    public function index()
    {
        if (request('gatunek')){
            $movies = Category::where('name', request('gatunek'))
            ->firstOrFail()
            ->movies()
            ->paginate(20);
        } else {
            $movies = Movie::latest()->paginate(20);
        }

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function create()
    {
        return view('movies.create', ['categories' => Category::get()]);
    }

    public function store(CreateMovie $request)
    {
        $movie = new Movie($request->validated());
        $movie->save();
        $movie->categories()->attach(request('categories'));
        
        return redirect($movie->path());
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Movie $movie, EditMovie $request)
    {
        $movie->update($request->validated());

        return redirect($movie->path());
    }
}
