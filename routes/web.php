<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\DashboardController;

// Route::get('/', function () { return view('home');})->name('home');
// Route::get('/', [DashboardController::class, 'index'])->name('home');
// Route::get('/', [AuthorController::class, 'home'])->name('home');
// Books Routes
Route::resource('books', BookController::class);
// Authors Routes
Route::resource('authors', AuthorController::class);
Route::get('/', [AuthorController::class, 'home'])->name('home');
// Author Books Route
Route::get('/{slug}/books', [AuthorController::class, 'authorbooks'])->name('books.author');


// Route::get('/{slug}/books', [DashboardController::class, 'authorbooks'])->name('books.author');
// Route::get('/{slug}/books', [DashboardController::class, 'authorbooks'])->name('books.author');




Route::middleware('auth')->group(function () {
    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Routes for guest users
Route::middleware('guest')->group(function () {
    // Register Routes
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login Routes
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);


});