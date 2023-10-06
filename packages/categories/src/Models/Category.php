<?php

namespace Package\Category\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Package\Movie\Models\Movie;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name'];

    public function movies()
    {
        return $this->hasMany(Movie::class, 'category_id', 'id');
    }
}
