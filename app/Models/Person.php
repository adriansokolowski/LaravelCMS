<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $table = 'persons';

    public function movies()
    {
        return $this->belongsToMany(Movie::class);
    }
}
