<?php

namespace Package\Comment\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Package\Comment\Http\Requests\CommentFormRequest;
use Package\Comment\Repositories\CommentRepository;
use Package\Movie\Repositories\MovieEpisodeRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentController extends Controller
{
    protected CommentRepository $commentRepository;
    protected MovieEpisodeRepository $episodeRepository;

    public function __construct(CommentRepository      $commentRepository,
                                MovieEpisodeRepository $episodeRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->episodeRepository = $episodeRepository;
    }

    public function fetchCommentsByMovieEpisode($id)
    {
        Log::info("Fetch comments by movie episode id #{$id}");
        if ($this->episodeRepository->checkExistsById($id)) {
            return $this->commentRepository->fetchCommentByMovieEpisode($id);
        }

        return response()->json([
            'message' => 'Movie episode is not found'
        ], STATUS_BAD_REQUEST);
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
