<?php

namespace Package\Movie\Http\Controllers;

use App\Enums\SourceType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Package\Media\Services\MediaService;
use Package\Movie\Http\Requests\MovieEpisodeFormRequest;
use Package\Movie\Repositories\MovieEpisodeRepository;
use Package\Movie\Repositories\ViewRepository;

class MovieEpisodeController extends Controller
{
    protected MovieEpisodeRepository $movieEpisodeRepository;
    protected ViewRepository $viewRepository;
    protected MediaService $mediaService;
    protected const DEFAULT_INDEX = 0;

    public function __construct(MovieEpisodeRepository $movieEpisodeRepository,
                                MediaService           $mediaService,
                                ViewRepository         $viewRepository)
    {
        $this->movieEpisodeRepository = $movieEpisodeRepository;
        $this->mediaService = $mediaService;
        $this->viewRepository = $viewRepository;
    }

    public function addMovieEpisode(MovieEpisodeFormRequest $request)
    {
        Log::info("Add new movie episode");

        $attribute = $request->all();
        $movieEpisodeId = $this->saveMovieEpisode($attribute);
        $this->saveMedia($request);

        $viewData = [
            'movie_episode_id' => $movieEpisodeId,
        ];
        $this->createView($viewData);

        return response()->json([
            "movie_episode_id" => $movieEpisodeId
        ], STATUS_CREATED);
    }

    private function createView($viewData)
    {
        $this->viewRepository->create($viewData);
    }

    private function saveMedia($request)
    {
        $movieId = $request->movie_id;
        $normalQualityFilm = $request->normal_quality_film;
        $highQualityFilm = $request->high_quality_film;
        $storedKeys = [$normalQualityFilm, $highQualityFilm];

        foreach ($storedKeys as $index => $storedKey) {
            $sourceType = $index === self::DEFAULT_INDEX
                ? SourceType::NORMAL_QUALITY_FILM
                : SourceType::HIGH_QUALITY_FILM;
            $attribute = [
                "movie_id" => $movieId,
                "stored_key" => $storedKey,
                "source_type" => $sourceType
            ];
            $this->mediaService->saveMedia($attribute);
        }

    }

    private function saveMovieEpisode($attribute)
    {
        $movieEpisode = $this->movieEpisodeRepository->create($attribute);
        return $movieEpisode->id;
    }

}
