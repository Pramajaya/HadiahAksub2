<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Movie;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserApiController;
use App\Http\Middleware\AdminApi;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/movie', [ApiController::class, 'getMovie'])->name('getMovie');
Route::post('/storePostMovie', [ApiController::class, 'storePostMovie'])->middleware('auth:sanctum', AdminApi::class);
Route::post('/updatePostMovie/{id}', [ApiController::class, 'updatePostMovie'])->middleware('auth:sanctum', AdminApi::class);
Route::post('/deletePostMovie/{id}', [ApiController::class, 'deletePostMovie'])->middleware('auth:sanctum', AdminApi::class);

Route::post('/movieRegister', [UserApiController::class, 'MovieRegister']);
Route::post('/movieLogin', [UserApiController::class, 'MovieLogin']);
Route::post('/movieLogout', [UserApiController::class, 'MovieLogout'])->middleware('auth:sanctum');
