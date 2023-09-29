<?php

use Illuminate\Support\Facades\Route;
use Package\Movie\Http\Controllers\MovieController;
use Package\Movie\Http\Controllers\MovieEpisodeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("api/v1/movies")->controller(MovieController::class)->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('', 'addMovie');
        Route::get('movies-with-types', 'fetchMovieWithMovieType');
    });
    Route::get('', 'fetchMovieForHomePage');
    Route::get('search', 'searchMovie');
    Route::get('countries/{name}', 'fetchMoviesByCountry');
});

Route::prefix("api/v1/movie-episodes")->controller(MovieEpisodeController::class)->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('', 'addMovieEpisode');
    });
});
