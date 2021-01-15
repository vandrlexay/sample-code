<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryFileAPIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('/countryfile/')->group(function () {
    Route::post('/upload', [CountryFileAPIController::class, 'upload'])->name('countryfile/upload');
    Route::post('/download', [CountryFileAPIController::class, 'download'])->name('countryfile/download');
    Route::get('/listFormats', [CountryFileAPIController::class, 'listFormats'])->name('countryfile/listFormats');
});
