<?php

namespace Package\Movie\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Package\Movie\Repositories\ViewRepository;

class ViewController extends Controller
{
    protected ViewRepository $viewRepository;

    public function __construct(ViewRepository $viewRepository)
    {
        $this->viewRepository = $viewRepository;
    }

    public function uploadViewCountForMovie($movieEpisodeId)
    {
        Log::info("Upload view count for movie with #{$movieEpisodeId}");

        $view = $this->viewRepository->where('movie_episode_id', $movieEpisodeId)->first();

        $view->increaseViewCount();

        return $view->id;
    }
}
