<?php

namespace Package\Media\Repositories;

use Package\Media\Models\Media;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class MediaRepositoryEloquent extends BaseRepository implements MediaRepository
{

    public function model()
    {
        return Media::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
