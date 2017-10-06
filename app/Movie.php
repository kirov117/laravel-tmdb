<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function genres()
    {
    	return $this->hasManyThrough(Genre::class, MovieGenre::class, 'movie_id', 'id');
    }
}
