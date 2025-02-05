<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;



// Books Routes
Route::resource('books', BookController::class);
// Authors Routes

Route::get('/', [AuthorController::class, 'home'])->name('authors.home');
// Author Books Route
Route::get('/{slug}/books', [AuthorController::class, 'authorBooks'])->name('authors.authorBooks');
Route::resource('authors', AuthorController::class);
Route::view('/book/create','authors.addBook');

Route::get('/authors/{slug}/books/add', [AuthorController::class, 'addNewBook'])->name('authors.addNewBook');
Route::post('/add/author', [AuthorController::class, 'addauthorapi'])->name('authors.addauthor');

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