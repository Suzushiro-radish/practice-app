<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\PostController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BookmarkController;

use App\Models\Instrument;

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
    Route::post('posts/{post}/bookmark/', [BookmarkController::class, 'store'])->name('bookmark.store');
    Route::post('posts/{post}/unbookmark/', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
    Route::get('mypage/bookmark', [BookmarkController::class, 'index'])->name('bookmarks');
    
});


//Search
Route::get('posts/search', SearchController::class)->name('search');

//Posts
Route::get('posts/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('instruments/all', [PostController::class, 'index'])->name('all.index');
Route::get('instruments/all/tags/{tag}', [TagController::class, 'posts']);
Route::get('instruments/{instrument}', [InstrumentController::class, 'posts']);
Route::get('instruments/{instrument}/tags/{tag}', [SearchController::class, 'posts']);

//楽器リスト
Route::get('/instruments', function(){
    return Inertia::render('Instruments/Instruments',[
        'instruments' => Instrument::all(),
        ]);
})->name('instruments');

require __DIR__.'/auth.php';