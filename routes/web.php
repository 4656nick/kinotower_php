<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Auth/Login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/categories', 'index')->name('categories');
        Route::post('/category', 'store')->name('category.create');
        Route::patch('/category/{id}', 'update')->name('category.update');
        Route::delete('/category/{id}', 'destroy')->name('category.delete');
    });
    Route::controller(CountryController::class)->group(function () {
        Route::get('/countries', 'index')->name('countries');
    });
    Route::controller(FilmController::class)->group(function () {
        Route::get('/films', 'index')->name('films');
        Route::post('/film', 'store')->name('film.create');
        Route::patch('/film/{id}', 'update')->name('film.update');
        Route::delete('/film/{id}', 'destroy')->name('film.delete');
    });
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index')->name('users');
        Route::delete('/users/{id}', 'destroy')->name('user.delete');
    });
    Route::controller(RatingController::class)->group(function () {
        Route::get('/ratings', 'index')->name('ratings');
    });
    Route::controller(ReviewController::class)->group(function () {
        Route::get('/reviews', 'index')->name('reviews');
    });
});