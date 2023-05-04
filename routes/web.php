<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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
    Route::post('/store', [BookController::class, 'store'])->name('book.store');
    Route::patch('/update/{book}', [BookController::class, 'update'])->name('book.update');

});