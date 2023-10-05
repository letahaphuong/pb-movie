<?php

namespace Package\Movie\Http\Controllers;

use App\Enums\MovieType;
use App\Enums\SourceType;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Package\Category\Repositories\CategoryRepository;
use Package\Country\Repositories\CountryRepository;
use Package\Media\Services\FileService;
use Package\Media\Services\MediaService;
use Package\Movie\Http\Requests\MovieFormRequest;
use Package\Movie\Repositories\MovieEpisodeRepository;
use Package\Movie\Repositories\MovieRepository;
use Package\Movie\Repositories\ViewRepository;
use Package\MovieType\Repositories\MovieTypeRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MovieController extends Controller
{
    protected const WORKING_IMAGES = 'working-images';
    protected const WORKING_VIDEOS = 'working-videos';
    protected FileService $fileService;
    protected MediaService $mediaService;
    protected MovieRepository $movieRepository;
    protected MovieEpisodeRepository $movieEpisodeRepository;
    protected MovieTypeRepository $movieTypeRepository;
    protected CountryRepository $countryRepository;
    protected CategoryRepository $categoryRepository;
    protected ViewRepository $viewRepository;
    protected const LIMIT = 24;
    protected const PER_PAGE = 12;
    protected const DEFAULT_MOVIE_TYPE = "Phim chiếu rạp,Phim bộ,Phim lẻ";
    protected const DEFAULT_PAGE = 1;
    protected const NO_NEXT_PAGE = 'No next page';
    protected const NO_PREVIOUS_PAGE = 'No prev page';
    private static array $sourceTypes = [
        SourceType::IMAGE_FILM => self::WORKING_IMAGES,
        SourceType::POSTER_FILM => self::WORKING_IMAGES,
        SourceType::NORMAL_QUALITY_FILM => self::WORKING_VIDEOS,
        SourceType::HIGH_QUALITY_FILM => self::WORKING_VIDEOS,
    ];

    public function __construct(MediaService           $mediaService,
                                FileService            $fileService,
                                MovieRepository        $movieRepository,
                                MovieEpisodeRepository $movieEpisodeRepository,
                                MovieTypeRepository    $movieTypeRepository,
                                CountryRepository      $countryRepository,
                                CategoryRepository     $categoryRepository,
                                ViewRepository         $viewRepository)
    {
        $this->mediaService = $mediaService;
        $this->fileService = $fileService;
        $this->movieRepository = $movieRepository;
        $this->movieEpisodeRepository = $movieEpisodeRepository;
        $this->movieTypeRepository = $movieTypeRepository;
        $this->countryRepository = $countryRepository;
        $this->categoryRepository = $categoryRepository;
        $this->viewRepository = $viewRepository;
    }

    public function getGroupDetail($id)
    {
        if (!$this->movieRepository->existsById($id)) {
            throw new NotFoundHttpException('Movie is not found');
        }

        $movie = $this->movieRepository->getMovieDetail($id);

        return $this->getPreSignedUrlForDetail($movie);
    }

    public function fetchMoviesByCategory($categoryName, Request $request)
    {
        Log::info("Fetch movie by category #{$categoryName}");

        $columns = ['categories.name'];
        $limit = $request->limit ?? self::LIMIT;
        $current_page = $request->page ?? self::DEFAULT_PAGE;
        $offset = ($current_page - 1) * $limit;

        $data = $this->categoryRepository->fetchMoviesBycategory($categoryName, $columns, $limit, $offset);
        $total = $this->movieRepository->getTotalMoviesByCategoryId($data->first()->id)->count();
        $movies = $data->first()->movies;
        $data = $this->getPreSignedUrlForSearch($movies);

        $next = self::NO_NEXT_PAGE;
        $prev = self::NO_PREVIOUS_PAGE;
        if ($total > $limit) {
            $next = $current_page < ceil($total / $limit) ? $current_page + 1 : self::NO_NEXT_PAGE;
            $prev = $current_page > 1 ? $current_page - 1 : self::NO_PREVIOUS_PAGE;
        }

        return [
            'category_name' => $categoryName,
            'data' => $data,
            'paginate' => compact('current_page', 'limit', 'offset', 'total', 'next', 'prev')
        ];
    }

    public function fetchMoviesByCountry($countryName, Request $request)
    {
        Log::info("Fetch movie by country #{$countryName}");

        $columns = ['countries.name'];
        $limit = $request->limit ?? self::LIMIT;
        $current_page = $request->page ?? self::DEFAULT_PAGE;
        $offset = ($current_page - 1) * $limit;

        $data = $this->countryRepository->fetchMoviesByCountry($countryName, $columns, $limit, $offset);
        $total = $this->movieRepository->getTotalMoviesByCountryId($data->first()->id)->count();
        $movies = $data->first()->movies;
        $data = $this->getPreSignedUrlForSearch($movies);

        $next = self::NO_NEXT_PAGE;
        $prev = self::NO_PREVIOUS_PAGE;
        if ($total > $limit) {
            $next = $current_page < ceil($total / $limit) ? $current_page + 1 : self::NO_NEXT_PAGE;
            $prev = $current_page > 1 ? $current_page - 1 : self::NO_PREVIOUS_PAGE;
        }

        return [
            'country_name' => $countryName,
            'data' => $data,
            'paginate' => compact('current_page', 'limit', 'offset', 'total', 'next', 'prev')
        ];
    }

    public function searchMovie(Request $request)
    {
        Log::info("Search movies");

        $keyword = $request->keyword ?? null;
        $perPage = $request->per_page ?? self::PER_PAGE;
        $columns = ['movies.name', 'movies.key_word', 'movies.actor_name', 'movies.name_english'];

        $sortBy = $request->input('sort_by', CREATED_AT);
        $sortType = $request->input('sort_type', DESC);

        $allowSort = [ASC, DESC];
        $sortType = in_array($sortType, $allowSort) ? $sortType : DESC;

        $sortBys = [
            'sort_by' => $sortBy,
            'sort_type' => $sortType,
        ];
        $listMovies = $this->movieRepository->searchMovie($keyword, $columns, $sortBys, $perPage);

        return $this->getPreSignedUrlForSearch($listMovies);
    }

    public function fetchMovieForHomePage(Request $request)
    {
        Log::info("Get data for home page");
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

        $movieEpisodeId = $this->createMovieEpisode($movieEpisodeData);
        $viewData = [
            'movie_episode_id' => $movieEpisodeId,
        ];

        $this->createView($viewData);
        return $movieId;
    }

    private function createView($viewData)
    {
        $this->viewRepository->create($viewData);
    }


    private function getPreSignedUrlForDetail($movie)
    {
        $medias = $movie->first()->medias;

        collect($medias)->map(function ($media, $key) {
            $media['stored_key'] = array_key_exists($media['source_type'], self::$sourceTypes) ?
                $this->fileService->getPreSignedUrl($media['stored_key'], self::$sourceTypes[$media['source_type']]) :
                $media['stored_key'];
        });
        return $movie;
    }

    private function getPreSignedUrlForSearch($listMovies)
    {
        foreach ($listMovies as $movie) {
            collect($movie->medias)->map(function ($media, $key) {
                $media['stored_key'] = array_key_exists($media['source_type'], self::$sourceTypes) ?
                    $this->fileService->getPreSignedUrl($media['stored_key'], self::$sourceTypes[$media['source_type']]) :
                    $media['stored_key'];
            });
        }
        return $listMovies;
    }

    private function getPreSignedUrl($listData)
    {
        array_walk_recursive($listData, function ($listMovieType, $key) {
            $listMovie = $listMovieType['movies'] ?? [];
            foreach ($listMovie as $movie) {
                collect($movie['medias'])->map(function ($media, $key) {
                    $media['stored_key'] = array_key_exists($media['source_type'], self::$sourceTypes) ?
                        $this->fileService->getPreSignedUrl($media['stored_key'], self::$sourceTypes[$media['source_type']]) :
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
