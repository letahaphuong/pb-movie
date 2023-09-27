<?php

namespace Package\Movie\Repositories;

use Package\Movie\Models\Movie;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class MovieRepositoryEloquent extends BaseRepository implements MovieRepository
{

    public function model()
    {
        return Movie::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function fetchMovieWithMovieType($movieType)
    {
        return Movie::select('id', 'name')->where('movie_type_id', $movieType)->get();
    }
}
