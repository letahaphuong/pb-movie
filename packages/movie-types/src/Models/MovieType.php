<?php

namespace Package\MovieType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Package\Movie\Models\Movie;

class MovieType extends Model
{
    use HasFactory;

    protected $table = 'movie_types';
    protected $fillable = ['name'];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'movie_type_id');
    }
}
