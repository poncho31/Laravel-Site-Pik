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

// Route::get('logout', 'Auth\LoginController@logout', function () {
//     return abort(404);
// });


    Auth::routes();
    Route::get('/', 'homeController@index');
    
    // Admin menu
    Route::middleware('auth')->group(function () {
        // dd($_REQUEST);
        Route::resource('image', 'ImageController');
    });
    
    // Static menu
    Route::get('contact', 'ContactController@index')->name('contact');
    Route::post('contact', 'ContactController@store')->name('contact');
    
    Route::get('about-me', 'homeController@aboutMe');
    
    Route::resource('in-progress', 'InprogressController');
    
    // Dynamic menu
    Route::get('{imagesSection}/{imagesProject}', 'ImageController@index');

