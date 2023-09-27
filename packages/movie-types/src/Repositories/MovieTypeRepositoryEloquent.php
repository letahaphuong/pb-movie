<?php

namespace Package\MovieType\Repositories;

use Package\MovieType\Models\MovieType;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class MovieTypeRepositoryEloquent extends BaseRepository implements MovieTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MovieType::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function fetchMovieType()
    {
        return MovieType::all();
    }
}
