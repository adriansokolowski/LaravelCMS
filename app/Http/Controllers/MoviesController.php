<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            ->movies()->paginate(20);
        } else {
            $movies = Movie::latest()->paginate(20);
        }

        $series = Serie::get();
        $categories = Category::get();

        return view('movies.index', compact('movies', 'series', 'categories'));
    }

    public function show(Movie $movie)
    {
        $categories = Category::get();

        return view('movies.show', compact('movie', 'categories'));
    }

    public function create()
    {
        $categories = Category::get();

        return view('movies.create', compact('categories'));
    }

    public function store()
    {
        Movie::create($this->validateMovie());
        
        return redirect(route('movies.index'));
    }

    public function edit(Movie $movie)
    {
        $categories = Category::get();

        return view('movies.edit', compact('categories', 'movie'));
    }

    public function update(Movie $movie)
    {
        $movie->update($this->validateMovie());

        return redirect($movie->path());
    }

    protected function validateMovie()
    {
        return request()->validate([
            'title' => ['required', 'min:3'],
            'desc' => 'required',
            'year' => 'required',
            'fdb' => 'required',
            'rate' => 'required',
            'view' => 'required'
        ]);
    }
    
}
