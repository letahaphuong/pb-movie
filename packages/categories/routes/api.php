<?php

use Illuminate\Support\Facades\Route;
use Package\Category\Http\Controllers\CategoriesController;

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

Route::prefix("api/v1/categories")->controller(CategoriesController::class)->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('add', 'createCategory');
        Route::get('detail/{id}', 'getCategory');
        Route::put('update', 'updateCategory');
        Route::delete('delete/{id}', 'deleteCategory');
    });
    Route::get('', 'fetchCategory');
});
