<?php

namespace Package\Movie\Repositories;

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

    public function getTotalMoviesByCategoryId($id)
    {
        return Movie::where('category_id', $id)->get();
    }

    public function getMovieDetail($id)
    {
        return Movie::select('movies.id', 'movies.name', 'movies.name_english', 'movies.key_word', 'movies.director',
            'movies.release_year', 'movies.description', 'movies.category_id', 'movies.country_id', 'movies.movie_type_id',
            'movies.time', 'movies.created_at')
            ->where('movies.id', $id)
            ->with([
                'country' => function (Builder $query) {
                    $query->select('countries.id', 'countries.name');
                },
                'category' => function (Builder $query) {
                    $query->select('categories.id', 'categories.name');
                },
                'movieType' => function (Builder $query) {
                    $query->select('movie_types.id', 'movie_types.name');
                },
                'movieEpisodes' => function (Builder $query) {
                    $query->select('movie_episodes.id', 'movie_episodes.movie_id', 'movie_episodes.name_episode');
                    $query->with(['view' => function (Builder $query) {
                        $query->select('views.id', 'views.movie_episode_id', 'views.view');
                    }]);
                },
                'medias' => function (Builder $query) {
                    $query->select('medias.id', 'medias.movie_id', 'medias.source_type', 'medias.stored_key');
                }
            ])
            ->get();
    }

    public function existsById($id)
    {
        return Movie::where('id', $id)->exists();
    }
}
