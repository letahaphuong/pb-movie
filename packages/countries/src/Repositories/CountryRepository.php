<?php

namespace Package\Country\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CountryRepository extends RepositoryInterface
{
    public function saveCountry($attribute);

    public function getCountry($id);

    public function fetchCountry();

    public function editCountry($attribute);

    public function exitsById($id);

    public function deleteCountry($country);

    public function fetchMoviesByCountry($countryName, array $columns, mixed $limit, float|int $offset);
}
