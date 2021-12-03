<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\route\RouteController;
use App\Http\Controllers\UserController;
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
    Route::get('/new-story', [RouteController::class, 'newStory'])->name('new-story');

    Route::post('/make-story', [BlogController::class, 'postStory'])->name('post.create');
    Route::post('/delete-story', [BlogController::class, 'deleteStory'])->name('post.delete');
    Route::get('/story/{id}/edit', [RouteController::class, 'editStory'])->name('post.edit');
    Route::get('/me/stories', [RouteController::class, 'listStory'])->name('post.list');
    Route::post('/story-update-status', [BlogController::class, 'updateStatus'])->name('post.status.update');
    Route::get('/{username}/profile', [RouteController::class, 'profile'])->name('profile');
    Route::post('/biodata', [UserController::class, 'bioProfile'])->name('profile.bio');

    Route::post('/ckeditor/upload', [BlogController::class, 'uploadCkEditor'])->name('ckeditor.upload');
    Route::get('/post/{post}/{randStr}', [RouteController::class, 'postDetail'])->name('post.detail');
});