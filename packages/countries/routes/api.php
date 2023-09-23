<?php

use Illuminate\Support\Facades\Route;
use Package\Country\Http\Controllers\CountriesController;

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

Route::prefix("api/v1/countries")->controller(CountriesController::class)->group(function () {
    Route::middleware('admin')->group(function () {
        Route::post('add', 'createCountry');
        Route::post('detail/{id}', 'getCountry');
        Route::put('update', 'updateCountry');
        Route::delete('delete/{id}', 'deleteCountry');
    });
    Route::get('', 'fetchCountry');
});
