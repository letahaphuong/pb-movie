<?php

namespace Package\Movie\Http\Controllers;

use App\Enums\MovieType;
use App\Enums\SourceType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Package\Media\Services\MediaService;
use Package\Movie\Http\Requests\MovieFormRequest;
use Package\Movie\Repositories\MovieEpisodeRepository;
use Package\Movie\Repositories\MovieRepository;

class MovieController extends Controller
{
    protected MediaService $mediaService;
    protected MovieRepository $movieRepository;
    protected MovieEpisodeRepository $movieEpisodeRepository;

    public function __construct(MediaService           $mediaService,
                                MovieRepository        $movieRepository,
                                MovieEpisodeRepository $movieEpisodeRepository)
    {
        $this->mediaService = $mediaService;
        $this->movieRepository = $movieRepository;
        $this->movieEpisodeRepository = $movieEpisodeRepository;
    }

    public function fetchMovieWithMovieType()
    {
        Log::info("Fetch movie for add new episode movie");

        return $this->movieRepository->fetchMovieWithMovieType(MovieType::FEATURE_FILM);
    }

    public function addMovie(MovieFormRequest $request)
    {
        Log::info("Add new movie with data #{$request->name}");

        $movieId = $this->createMovie($request->all());
        $this->saveMedia($request, $movieId);

        $nameEpisode = $request->name_episode;
        $movieEpisodeData = [
            'movie_id' => $movieId,
            'name_episode' => $nameEpisode,
        ];

        $this->createMovieEpisode($movieEpisodeData);

        return $movieId;
    }

    private function saveMedia($request, $movieId)
    {
        $imageFilm = $request->image_film;
        $posterFilm = $request->poster_film;
        $normalQualityFilm = $request->normal_quality_film;
        $highQualityFilm = $request->high_quality_film;
        $storedKeys = [$imageFilm, $posterFilm, $normalQualityFilm, $highQualityFilm];
        $sourceType = [];
        foreach ($storedKeys as $index => $storedKey) {
            $sourceType = match ($index) {
                0 => SourceType::IMAGE_FILM,
                1 => SourceType::POSTER_FILM,
                2 => SourceType::NORMAL_QUALITY_FILM,
                default => SourceType::HIGH_QUALITY_FILM,
            };
            $attribute = [
                "movie_id" => $movieId,
                "stored_key" => $storedKey,
                "source_type" => $sourceType
            ];
            $this->mediaService->saveMedia($attribute);
        }
    }

    private function createMovieEpisode($movieEpisodeData)
    {
        $movieEpisode = $this->movieEpisodeRepository->create($movieEpisodeData);
        return $movieEpisode->id;
    }

    private function createMovie($movieData)
    {
        $movie = $this->movieRepository->create($movieData);
        return $movie->id;
    }
}
