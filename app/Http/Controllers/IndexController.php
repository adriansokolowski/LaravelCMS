<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Movie;
use App\Serie;
use App\Category;

class IndexController extends Controller
{
    public function index(){
        $movies = Movie::take(20)->latest()->get();
        $series = Serie::get();
        $categories = Category::get();
        return view('index', compact('movies', 'series', 'categories'));
    }
}
