<?php

namespace Package\Movie\Repositories;

use Package\Movie\Models\MovieEpisode;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class MovieEpisodeRepositoryEloquent extends BaseRepository implements MovieEpisodeRepository
{

    public function model()
    {
        return MovieEpisode::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function checkExistsById($id)
    {
        return MovieEpisode::where('id', $id)->exists();
    }
}
