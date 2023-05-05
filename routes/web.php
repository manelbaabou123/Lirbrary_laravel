<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::post('/books', 'BookController@store');
Route::prefix('books')->group(function () {
    Route::get('/index', [BookController::class, 'index'])->name('book.index');
    Route::post('/store', [BookController::class, 'store'])->name('book.store');
    Route::patch('/update/{book}', [BookController::class, 'update'])->name('book.update');
    Route::delete('/destroy/{book}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('/show/{book}', [BookController::class, 'show'])->name('book.show');
});
Route::prefix('authors')->group(function () {
    Route::get('/index', [AuthorController::class, 'index'])->name('author.index');
    Route::post('/store', [AuthorController::class, 'store'])->name('author.store');
    Route::patch('/update/{author}', [AuthorController::class, 'update'])->name('author.update');
    Route::delete('/destroy/{author}', [AuthorController::class, 'destroy'])->name('author.destroy');
    Route::get('/show/{author}', [AuthorController::class, 'show'])->name('author.show');
});