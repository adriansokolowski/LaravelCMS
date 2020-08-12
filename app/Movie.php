<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'user_id', 
        'release_date',
        'description',
        'imdb_rate',
        'fdb'
    ];

    protected $casts = [
        'release_date' => 'datetime:Y-m-d',
    ];

    public function path()
    {
        return route('movies.show', [$this, Str::slug($this->title . '-' . $this->release_date->year)]);
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }

    public function links()
    {
        return $this->hasMany('App\Link');
    }
}
