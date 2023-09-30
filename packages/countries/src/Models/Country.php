<?php

namespace Package\Country\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Package\Movie\Models\Movie;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $fillable = ['name'];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'country_id', 'id');
    }
}
