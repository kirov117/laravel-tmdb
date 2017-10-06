<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovieGenre extends Model
{
    public $timestamps = false;

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
