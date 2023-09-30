<?php

namespace Package\Movie\Repositories;

use App\Core\CoreModel\CoreModel;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Package\Movie\Models\Movie;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

class MovieRepositoryEloquent extends BaseRepository implements MovieRepository
{
    public function model()
    {
        return Movie::class;
    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function fetchMovieWithMovieType($movieType)
    {
        return Movie::select('id', 'name')->where('movie_type_id', $movieType)->get();
    }

    public function searchMovie($keywords = '', $columns = [], $sortBys = [], $perPage = 0)
    {
        return Movie::select(
            array_merge($columns, ['movies.id', 'movies.created_at'])
        )
            ->where(function (Builder $query) use ($columns, $keywords) {
                scopeOrWhereLike($query, $columns, $keywords);
            })
            ->with(['medias' => function (Builder $query) {
                $query->select('medias.id', 'medias.movie_id', 'medias.stored_key', 'medias.source_type');
            }])
            ->orderBy('movies.' . $sortBys['sort_by'], $sortBys['sort_type'])
            ->paginate($perPage);
    }

    public function getTotalMoviesByCountryId($id)
    {
        return Movie::where('country_id', $id)->get();
    }
}
