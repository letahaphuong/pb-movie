<?php

namespace Package\MovieType\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MovieType extends Model
{
    use HasFactory;

    protected $table = 'movie_types';
    protected $fillable = ['name'];
}
