<?php

use App\Http\Controllers\route\RouteController;
use Illuminate\Support\Facades\Route;

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

// BLOG
Route::name('blog.')->group(function () {
    Route::get('/', [RouteController::class, 'blogHome'])->name('home');
    Route::get('/post/{post:slug}', [RouteController::class, 'postDetail'])->name('post.detail');
});
