<?php

namespace Package\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Package\Comment\Http\Requests\CommentFormRequest;
use Package\Comment\Repositories\CommentRepository;

class CommentController extends Controller
{
    protected CommentRepository $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function createComment(CommentFormRequest $request)
    {
        Log::info("Add new comment");

        $attribute = $request->all();

        return $this->saveComment($attribute);
    }

    private function saveComment($attribute)
    {
        $comment = $this->commentRepository->create($attribute);
        return $comment->id;
    }
}
