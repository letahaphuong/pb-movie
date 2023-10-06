<?php

namespace Package\MovieType\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface MovieTypeRepository extends RepositoryInterface
{
    public function fetchMovieType();

    public function fetchDataForHomePage($movieTypes, $limit);
}
