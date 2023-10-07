<?php

use Illuminate\Support\Facades\Route;
use Package\Comment\Http\Controllers\CommentController;

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

Route::prefix("api/v1/comments")->controller(CommentController::class)->group(function () {
    Route::post('', 'createComment');
    Route::get('/{id}', 'fetchCommentsByMovieEpisode');
});

