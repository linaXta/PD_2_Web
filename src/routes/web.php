<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DirectorController;

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

Route::get('/directors', [DirectorController::class, 'list']);

// pievienot
Route::get('/directors/create', [DirectorController::class, 'create']);
Route::post('/directors/put', [DirectorController::class, 'put']);

// labot
Route::get('/directors/update/{director}', [DirectorController::class, 'update']);
Route::post('directors/patch/{director}', [DirectorController::class, 'patch']);

// dzēst
Route::post('directors/delete/{director}', [DirectorController::class, 'delete']);