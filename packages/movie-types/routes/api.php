<?php

use Illuminate\Support\Facades\Route;
use Package\MovieType\Http\Controllers\MovieTypeController;

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

Route::prefix("api/v1/movie-types")->controller(MovieTypeController::class)->group(function () {
    Route::middleware('admin')->group(function () {
    });
    Route::get('', 'fetchMovieType');
});
