<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Movie extends Model
{
    protected $guarded = [];
    
    public function path()
    {
        return route('movies.show', [$this, Str::slug($this->title. '-' .$this->year)]);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function links(){
        return $this->hasMany('App\Link');
    }
}
