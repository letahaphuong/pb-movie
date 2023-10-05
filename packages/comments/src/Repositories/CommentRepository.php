<?php

namespace Package\Comment\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CommentRepository extends RepositoryInterface
{
    public function fetchCommentByMovieEpisode($id);
}
