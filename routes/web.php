<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DrinkController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoriteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('cafe.home');

Route::get('/register', [RegistrationController::class, 'index'])->name('registration.index');
Route::post('/register', [RegistrationController::class, 'register'])->name('registration.create');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/profile/comments/{id}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::patch('/profile/comments/{id}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/profile/comments/{id}', [CommentController::class, 'delete'])->name('comment.delete');

    Route::get('profile/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');
    Route::patch('profile/reviews/{id}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('profile/reviews/{id}', [ReviewController::class, 'delete'])->name('review.delete');

    Route::get('/cafes/new', [CafeController::class, 'create'])->name('cafe.create');
    Route::post('/cafes', [CafeController::class, 'store'])->name('cafe.store');
    Route::get('/cafes', [CafeController::class, 'index'])->name('cafe.index');
    Route::get('/cafes/{id}', [CafeController::class, 'show'])->name('cafe.show');
    Route::get('/cafes/{id}/edit', [CafeController::class, 'edit'])->name('cafe.edit');
    Route::patch('/cafes/{id}', [CafeController::class, 'update'])->name('cafe.update');
    Route::delete('/cafes/{id}', [CafeController::class, 'delete'])->name('cafe.delete');

    Route::get('/cafes/{cafe_id}/comments/new', [CommentController::class, 'create'])->name('comment.create');
    Route::post('/cafes/{cafe_id}/comments', [CommentController::class, 'store'])->name('comment.store');
    
    Route::get('/cafes/{cafe_id}/reviews/new', [ReviewController::class, 'create'])->name('review.create');
    Route::post('/cafes/{cafe_id}/reviews', [ReviewController::class, 'store'])->name('review.store');

    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorite.index');
    Route::post('/favorites/{cafe_id}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorites/{id}', [FavoriteController::class, 'delete'])->name('favorite.delete');

    Route::get('/drinks/new', [DrinkController::class, 'create'])->name('drink.create');
    Route::post('/drinks', [DrinkController::class, 'store'])->name('drink.store');
    Route::get('/drinks/{id}/edit', [DrinkController::class, 'edit'])->name('drink.edit');
    Route::patch('/drinks/{id}', [DrinkController::class, 'update'])->name('drink.update');
    Route::delete('/drinks/{id}', [DrinkController::class, 'delete'])->name('drink.delete');
    Route::get('/drinks/{id}', [DrinkController::class, 'confirmation'])->name('drink.confirmation');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});