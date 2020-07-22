<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\CreateMovie;

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
        return view('movies.create');
    }

    public function store(CreateMovie $request)
    {
        $validated = $request->validated();
        dd($validated);
        //$output = $this->validateMovie();
        //$output['view'] = $output['view'] ?? 0;
        Movie::create(
            
        );
        
        return redirect(route('movies.index'));
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Movie $movie)
    {
        $movie->update($this->validateMovie());

        return redirect($movie->path());
    }

    // protected function validateMovie()
    // {      
    //     return request()->validate([
    //         'title' => ['required', 'between:3,255'],
    //         'desc' => 'required',
    //         'year' => ['required', 'integer'],
    //         'fdb' => ['required', 'integer'],
    //         'rate' => ['required', 'numeric'],
    //         'view' => ['nullable', 'integer']
    //     ]);
    // }
    
}
