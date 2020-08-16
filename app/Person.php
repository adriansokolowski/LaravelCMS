<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $fillable = [
        'name'
    ];

    protected $table = 'persons';

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
