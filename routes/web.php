<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CheckinController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;

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
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
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

Route::post('/checkout/{book}', [CheckoutController::class, 'store'])->name('checkout.store');
Route::post('/checkin/{book}', [CheckinController::class, 'store'])->name('checkout.store');


