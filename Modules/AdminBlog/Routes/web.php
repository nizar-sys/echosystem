<?php

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

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function() {
    Route::get('/', 'Route\RouteController@index')->name('login');
    
    /* ===Begin Auth=== */
    Route::resource('login', 'Auth\LoginController');

    Route::get('/{provider}/login', 'Auth\LoginWithSocialliteController@redirect')->name('provider.login');
    Route::get('{provider}/callback', 'Auth\LoginWithSocialliteController@callback')->name('provider.post.login');
    /* ===End Auth=== */

    /* ===Has Auth=== */
    Route::middleware('auth')->group(function(){
        Route::get('/dashboard', 'Route\RouteController@dashboard')->name('admin.home');

        Route::get('/logout', 'Route\RouteController@logout')->name('admin.logout');
    });

});
