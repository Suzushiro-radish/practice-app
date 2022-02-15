<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookmarkController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('posts/search', SearchController::class)->name('search');

Route::resource('posts', PostController::class);

Route::get('posts/instruments/{instrument}', [InstrumentController::class, 'index']);

Route::get('posts/tags/{tag}', [TagController::class, 'index']);

Route::post('posts/{post}/bookmark/', [BookmarkController::class, 'store']);

Route::post('posts/{post}/unbookmark/', [BookmarkController::class, 'destroy']);

require __DIR__.'/auth.php';
