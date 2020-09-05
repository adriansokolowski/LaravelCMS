<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Movie;
use App\Http\Resources\Admin\MovieResource;

class MovieController extends Controller
{
    public function index()
    {
        return MovieResource::collection(Movie::all());
    }
}
