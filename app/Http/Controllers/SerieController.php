<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::latest()->paginate(20);
        return view('series.index', compact('series'));
    }

    public function show(Serie $serie)
    {
        return view('series.show', compact('serie'));
    }
}
