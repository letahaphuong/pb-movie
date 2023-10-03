<?php

namespace Package\Movie\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieEpisode extends Model
{
    use HasFactory;

    protected $table = 'movie_episodes';
    protected $fillable = [
        'name_episode',
        'movie_id',
    ];

    public function view()
    {
        return $this->hasOne(View::class, 'movie_episode_id', 'id');
    }
}
