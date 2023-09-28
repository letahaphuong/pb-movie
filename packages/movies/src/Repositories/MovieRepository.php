<?php

namespace Package\Movie\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface MovieRepository extends RepositoryInterface
{
    public function fetchMovieWithMovieType($movieType);

    public function searchMovie($keywords = '',$columns = [], $sortBys = [], $perPage = 0);
}