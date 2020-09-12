<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Resources\CountryResource;

class CountryApiController extends Controller
{
    public function index(){
        return CountryResource::collection(Country::all());
    }
}
