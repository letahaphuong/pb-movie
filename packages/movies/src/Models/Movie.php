<?php

namespace Package\Movie\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    protected $fillable = [
        'name',
        'name_english',
        'key_word',
        'actor_name',
        'director',
        'release_year',
        'time',
        'description',
        'view',
        'category_id',
        'movie_type_id',
        'country_id',
    ];
}
