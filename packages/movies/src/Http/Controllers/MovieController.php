<?php

namespace Package\Movie\Http\Controllers;

use App\Http\Controllers\Controller;

class MovieController extends Controller
{

    public function __construct()
    {
    }

    public function fetchMovie()
    {
        return 'ok';
    }
}
