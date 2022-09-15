<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/movies');
});

Route::prefix('movies')->group(function() {
    Route::get('/', [MovieController::class, 'index'])->name('movies');
    Route::get('/{id}', [MovieController::class, 'show'])->name('movie');
    Route::get('/{id}/update', [MovieController::class, 'update'])->name('movie-update');
    Route::post('/{id}/update', [MovieController::class, 'store'])->name('movie-store');
    Route::get('/{id}/destroy', [MovieController::class, 'destroy'])->name('movie-destroy');
});

Route::prefix('genres')->group(function() {
    Route::get('/', [GenreController::class, 'index'])->name('genres');
    Route::get('/add', [GenreController::class, 'add'])->name('genre-add');
    Route::post('/create', [GenreController::class, 'create'])->name('genre-create');
    Route::get('/{id}/update', [GenreController::class, 'update'])->name('genre-update');
    Route::post('/{id}/update', [GenreController::class, 'store'])->name('genre-store');
    Route::get('/{id}/destroy', [GenreController::class, 'destroy'])->name('genre-destroy');
});
