<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


/*
    CRUD
*/


Route::get('posts/{id}/download' , [PostController::class , 'download'])->name('posts.download');
Route::get('/posts/trash' , [PostController::class,'trash'])->name('posts.trashed');
Route::get('posts/{id}/restore' , [PostController::class , 'restore'])->name('posts.restore');
Route::delete('posts/{id}/fdelete' , [PostController::class,'fdelete'])->name('posts.fdelete');

Route::resource('posts' , PostController::class);


Route::get('lang' , function(){

    return view('greeting');
});

Route::get('/lang/{locale}' , function($locale){
    App::setlocale($locale);

    return view('greeting');
    
})->name('greeting');