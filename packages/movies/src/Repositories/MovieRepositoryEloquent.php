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
}
