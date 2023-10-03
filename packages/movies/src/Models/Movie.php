<?php

namespace Package\Movie\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Package\Category\Models\Category;
use Package\Country\Models\Country;
use Package\Media\Models\Media;
use Package\MovieType\Models\MovieType;

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

    public function increaseViewCount()
    {
        $this->view++;
        $this->save();
    }

    public function medias()
    {
        return $this->hasMany(Media::class, 'movie_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function movieType()
    {
        return $this->hasOne(MovieType::class, 'id', 'movie_type_id');
    }

    public function movieEpisodes()
    {
        return $this->hasMany(MovieEpisode::class, 'movie_id', 'id');
    }
}
