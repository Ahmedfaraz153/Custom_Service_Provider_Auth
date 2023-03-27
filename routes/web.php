<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DashboardController;


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

// Route::get('/post',[PostController::class,'index'])->middleware(['can:isAdmin,App\Models\Post'])->name('post_index');
Route::get('/post',[PostController::class,'index'])->name('post_index') ;
Route::post('/post',[PostController::class,'create'])->name('post_create');
Route::get('/edit/{id}',[PostController::class,'edit'])->name('post_edit');
Route::post('/edit/{id}',[PostController::class,'update'])->name('post_update');
Route::get('/delete/{id}',[PostController::class,'destroy'])->name('post_delete');




Route::get('/dashboard',[DashboardController::class,'show_post'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
