<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

use App\Http\Requests\CreateMovie;
use App\Http\Requests\EditMovie;

use App\Models\Fdb;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Serie;
use App\Models\Link;

class MovieController extends Controller
{
    public function import(Request $request)
    {
        $fdb = (new Fdb($request->post('title')))->results();
        return response()->json($fdb);
    }

    public function index()
    {
        if (request('gatunek')) {
            $movies = Category::where('name', request('gatunek'))
                ->firstOrFail()
                ->movies()
                ->paginate(20);
        } elseif (request('rok')) {
            $movies = Movie::where('year', request('rok'))
                ->paginate(20);
        } else {
            $movies = Movie::latest()->paginate(20);
        }

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        $movie->increment('views');
        return view('movies.show', compact('movie'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(CreateMovie $request)
    {
        $request->validated();
        $movie = new Movie(request(['title', 'user_id', 'desc', 'year', 'fdb', 'imdb_rate', 'view']));
        $movie->save();
        request()->poster->storeAs('poster', $movie->id . '.jpg', 'public');
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
