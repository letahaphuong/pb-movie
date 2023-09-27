<?php

namespace Package\MovieType\Repositories;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Package\MovieType\Models\MovieType;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class MovieTypeRepositoryEloquent extends BaseRepository implements MovieTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MovieType::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function fetchMovieType()
    {
        return MovieType::all();
    }

    public function fetchDataForHomePage($movieTypes, $limit)
    {
        return MovieType::select('id', 'name')
            ->whereIn('name', $movieTypes)
            ->with(['movies' => function (Builder $query) use ($limit) {
                $query->select(
                    'movies.id', 'movies.name', 'movies.name_english', 'movies.movie_type_id', 'movies.created_at')
                    ->orderBy(CREATED_AT, DESC)
                    ->limit($limit)
                    ->with(['medias' => function (Builder $query) {
                        $query->select('medias.id', 'medias.movie_id', 'medias.stored_key', 'medias.source_type');
                    }]);
            }])->get();
    }
}
