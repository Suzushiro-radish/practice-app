<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SearchController;

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

Route::middleware(['auth'])->group(function () {
    
    Route::post('posts/{post}/bookmark/', [BookmarkController::class, 'store']);
    
    Route::post('posts/{post}/unbookmark/', [BookmarkController::class, 'destroy']);
    
    Route::get('mypage/bookmark', [BookmarkController::class, 'index']);
    
});

Route::get('posts/search', SearchController::class)->name('search');

Route::resource('posts', PostController::class);

Route::get('instruments/all', [PostController::class,'index']);

Route::get('instruments/all/tags/{tag}', [TagController::class, 'posts']);

Route::get('instruments/{instrument}', [InstrumentController::class, 'posts']);

Route::get('instruments/{instrument}/tags/{tag}', [SearchController::class, 'posts']);

require __DIR__.'/auth.php';

require __DIR__.'/auth.php';
