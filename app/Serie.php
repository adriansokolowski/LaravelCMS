<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    public function path()
    {
        return route('series.show', $this);
    }
}
