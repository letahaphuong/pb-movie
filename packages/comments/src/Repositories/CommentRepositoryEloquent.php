<?php

namespace Package\Comment\Repositories;

use Package\Comment\Models\Comment;
use Prettus\Repository\Eloquent\BaseRepository;

class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{

    public function model()
    {
        return Comment::class;
    }
}
