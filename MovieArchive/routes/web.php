<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsLogin;

Route::get('/home', function () {
    return view('home');
});

Route::controller(MovieController::class)->middleware(IsLogin::class)->group(function() {
    Route::get('/home', 'getHome')->name('getHome');
    Route::middleware(IsAdmin::class)->group(function() {
        Route::get('/createMovie', 'getCreateMovie')->name('getCreateMovie');
        Route::post('/storeMovie', 'storeMovie')->name('storeMovie');
        Route::Get('/updateMovie/{id}', 'updateMovie')->name('updateMovie');
        Route::post('/editMovie/{id}', 'editMovie')->name('editMovie');
        Route::post('/deleteMovie/{id}', 'deleteMovie')->name('deleteMovie');
    });
});

Route::get('/register', [UserController::class, 'getRegister'])->name('getRegister');
Route::post('/storeRegister', [UserController::class, 'storeRegister'])->name('storeRegister');
Route::get('/login', [UserController::class, 'getLogin'])->name('getLogin');
Route::post('/storeLogin', [UserController::class, 'storeLogin'])->name('storeLogin');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');



