<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;
use App\Serie;

class IndexController extends Controller
{
    public function index()
    {
        $movies = Movie::take(20)->latest()->get();
        $movies_popular = Movie::take(20)->orderBy('view')->get();
        $series = Serie::get();

        return view('index', compact('movies', 'series', 'movies_popular'));
    }
}
