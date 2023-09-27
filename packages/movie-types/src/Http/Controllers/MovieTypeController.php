<?php

namespace Package\MovieType\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Package\MovieType\Repositories\MovieTypeRepository;

class MovieTypeController extends Controller
{
    protected MovieTypeRepository $movieTypeRepository;

    public function __construct(MovieTypeRepository $movieTypeRepository)
    {
        $this->movieTypeRepository = $movieTypeRepository;
    }

    public function fetchMovieType()
    {
        return $this->movieTypeRepository->fetchMovieType();
    }

}
