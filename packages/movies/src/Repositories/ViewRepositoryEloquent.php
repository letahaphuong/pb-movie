<?php

namespace Package\Movie\Repositories;

use Package\Movie\Models\View;
use Prettus\Repository\Eloquent\BaseRepository;

class ViewRepositoryEloquent extends BaseRepository implements ViewRepository
{

    public function model()
    {
        return View::class;
    }
}
