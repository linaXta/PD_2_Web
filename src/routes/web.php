<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\DataController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);



//Director routes

Route::get('/directors', [DirectorController::class, 'list']);
// pievienot
Route::get('/directors/create', [DirectorController::class, 'create']);
Route::post('/directors/put', [DirectorController::class, 'put']);
// labot
Route::get('/directors/update/{director}', [DirectorController::class, 'update']);
Route::post('directors/patch/{director}', [DirectorController::class, 'patch']);
// dzēst
Route::post('directors/delete/{director}', [DirectorController::class, 'delete']);


//Movie routes
Route::get('/movies', [MovieController::class, 'list']);
Route::get('/movies/create', [MovieController::class, 'create']);
Route::post('/movies/put', [MovieController::class, 'put']);
Route::get('/movies/update/{movie}', [MovieController::class, 'update']);
Route::post('movies/patch/{movie}', [MovieController::class, 'patch']);
Route::post('movies/delete/{movie}', [MovieController::class, 'delete']);

//Genre routes
Route::get('/genres', [GenreController::class, 'list']);
// pievienot
Route::get('/genres/create', [GenreController::class, 'create']);
Route::post('/genres/put', [GenreController::class, 'put']);
// labot
Route::get('/genres/update/{genre}', [GenreController::class, 'update']);
Route::post('genres/patch/{genre}', [GenreController::class, 'patch']);
// dzēst
Route::post('genres/delete/{genre}', [GenreController::class, 'delete']);



// Auth routes // ielagoties
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

// Data routes
Route::prefix('data')->group(function(){
    Route::get('/get-top-movies', [DataController::class, 'getTopMovies']);
    Route::get('/get-movie/{movie}', [DataController::class, 'getMovie']);
    Route::get('/get-related-movies/{movie}', [DataController::class, 'getRelatedMovies']);
});
