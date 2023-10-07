<?php

namespace Package\Movie\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface MovieEpisodeRepository extends RepositoryInterface
{
    public function checkExistsById($id);
}
