<?php

namespace Package\Movie\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $table = 'views';
    protected $fillable = [
        'movie_episode_id',
        'view',
    ];

    public function increaseViewCount()
    {
        $this->view++;
        $this->save();
    }
}
