<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//AUTHENTIFICATED ONLY
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)->only([
        'create', 'store', 'update', 'edit', 'destroy', 
    ]);
    Route::post('posts/{post}/bookmark/', [BookmarkController::class, 'store']);
    Route::post('posts/{post}/unbookmark/', [BookmarkController::class, 'destroy']);
    Route::get('mypage/bookmark', [BookmarkController::class, 'index']);
    
});


//Search
Route::get('posts/search', SearchController::class)->name('search');

//Posts
Route::get('posts/{post}', [PostController::class, 'show']);
Route::get('instruments/all', [PostController::class, 'index'])->name('all.index');
Route::get('instruments/all/tags/{tag}', [TagController::class, 'posts']);
Route::get('instruments/{instrument}', [InstrumentController::class, 'posts']);
Route::get('instruments/{instrument}/tags/{tag}', [SearchController::class, 'posts']);

require __DIR__.'/auth.php';