<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = [];
    
    public function path()
    {
        return route('movies.show', $this);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function links(){
        return $this->hasMany('App\Link');
    }
}
