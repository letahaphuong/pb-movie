<?php

namespace Package\Movie\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface MovieRepository extends RepositoryInterface
{
    public function fetchMovieWithMovieType($movieType);

    public function searchMovie($keywords = '', $columns = [], $sortBys = [], $perPage = 0);

    public function getTotalMoviesByCountryId($id);

    public function getTotalMoviesByCategoryId($id);

    public function getMovieDetail($id);

    public function existsById($id);
}
