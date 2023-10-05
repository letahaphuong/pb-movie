<?php

namespace Package\Comment\Repositories;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Package\Comment\Models\Comment;
use Package\Movie\Models\MovieEpisode;
use Prettus\Repository\Eloquent\BaseRepository;

class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{

    public function model()
    {
        return Comment::class;
    }

    public function fetchCommentByMovieEpisode($id)
    {
        return MovieEpisode::select('movie_episodes.id', 'movie_episodes.name_episode')
            ->where('id', $id)
            ->with(['comments' => function (Builder $query) {
                $query->select(
                    'comments.id', 'comments.content',
                    'comments.user_id', 'comments.movie_episode_id');
            }])
            ->get();
    }
}
