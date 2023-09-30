<?php

namespace Package\Country\Repositories;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Package\Country\Models\Country;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class CountryRepositoryEloquent extends BaseRepository implements CountryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Country::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function saveCountry($attribute)
    {
        return Country::create($attribute);
    }

    public function getCountry($id)
    {
        return Country::findOrFail($id);
    }

    public function fetchCountry()
    {
        return Country::all();
    }

    public function editCountry($attribute)
    {
        return Country::where('id', '=', $attribute['id'])->update($attribute);

    }

    public function exitsById($id)
    {
        return Country::findOrFail($id);
    }

    public function deleteCountry($country)
    {
        $country->delete();
    }

    public function fetchMoviesByCountry($countryName, array $columns, mixed $limit, float|int $offset)
    {
        return Country::where(function (Builder $query) use ($columns, $countryName, $limit, $offset) {
                scopeOrWhereLike($query, $columns, $countryName);
            })
            ->with(['movies' => function (Builder $query) use ($limit, $offset) {
                $query->select('movies.id', 'movies.name', 'movies.name_english',
                               'movies.country_id', 'movies.created_at')
                      ->orderBy(CREATED_AT, DESC)
                      ->limit($limit)
                      ->offset($offset)
                      ->with(['medias' => function (Builder $query) {
                          $query->select('medias.id', 'medias.movie_id', 'medias.stored_key', 'medias.source_type');
                      }]);
            }])
            ->get();
    }
}
