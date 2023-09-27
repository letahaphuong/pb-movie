<?php

namespace Package\Movie\Http\Controllers;

use App\Enums\MovieType;
use App\Enums\SourceType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Package\Media\Services\FileService;
use Package\Media\Services\MediaService;
use Package\Movie\Http\Requests\MovieFormRequest;
use Package\Movie\Repositories\MovieEpisodeRepository;
use Package\Movie\Repositories\MovieRepository;
use Package\MovieType\Repositories\MovieTypeRepository;

class MovieController extends Controller
{
    protected const WORKING_IMAGES = 'working-images';
    protected const WORKING_VIDEOS = 'working-videos';
    protected FileService $fileService;
    protected MediaService $mediaService;
    protected MovieRepository $movieRepository;
    protected MovieEpisodeRepository $movieEpisodeRepository;
    protected MovieTypeRepository $movieTypeRepository;
    protected const LIMIT = 24;
    protected const DEFAULT_MOVIE_TYPE = "Phim chiếu rạp,Phim bộ,Phim lẻ";

    public function __construct(MediaService           $mediaService,
                                FileService            $fileService,
                                MovieRepository        $movieRepository,
                                MovieEpisodeRepository $movieEpisodeRepository,
                                MovieTypeRepository    $movieTypeRepository)
    {
        $this->mediaService = $mediaService;
        $this->fileService = $fileService;
        $this->movieRepository = $movieRepository;
        $this->movieEpisodeRepository = $movieEpisodeRepository;
        $this->movieTypeRepository = $movieTypeRepository;
    }

    public function fetchMovieForHomePage(Request $request)
    {
        Log::info("Search movies");
        $keyword = $request->keyword ?? self::DEFAULT_MOVIE_TYPE;
        $movieTypes = explode(",", $keyword);

        $listData = $this->movieTypeRepository->fetchDataForHomePage($movieTypes, self::LIMIT);

        return $this->getPreSignedUrl($listData);
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

    private function getPreSignedUrl($listData)
    {
        array_walk_recursive($listData, function ($listMovieType, $key) {
            $sourceTypes = [
                SourceType::IMAGE_FILM => self::WORKING_IMAGES,
                SourceType::POSTER_FILM => self::WORKING_IMAGES,
                SourceType::NORMAL_QUALITY_FILM => self::WORKING_VIDEOS,
                SourceType::HIGH_QUALITY_FILM => self::WORKING_VIDEOS,
            ];
            $listMovie = $listMovieType['movies'] ?? [];
            foreach ($listMovie as $movie) {
                collect($movie['medias'])->map(function ($media, $key) use ($sourceTypes) {
                    $media['stored_key'] = array_key_exists($media['source_type'], $sourceTypes) ?
                        $this->fileService->getPreSignedUrl($media['stored_key'], $sourceTypes[$media['source_type']]) :
                        $media['stored_key'];
                });
            }
        });

        return $listData;
    }

    private function saveMedia($request, $movieId)
    {
        $imageFilm = $request->image_film;
        $posterFilm = $request->poster_film;
        $normalQualityFilm = $request->normal_quality_film;
        $highQualityFilm = $request->high_quality_film;
        $storedKeys = [$imageFilm, $posterFilm, $normalQualityFilm, $highQualityFilm];

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
