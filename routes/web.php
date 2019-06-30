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

    Route::get('logout', 'Auth\LoginController@logout', function () {return abort(404);});
    Auth::routes();
    // Admin menu
    Route::middleware('auth')->group(function () {
        Route::resource('image', 'ImageController');
        Route::resource('in-progress', 'InprogressController');
        Route::get('delete', 'ImageController@globalDeleteView')->name('delete');
        Route::post('delete', 'ImageController@globalDelete')->name('delete');
    });
    
    Route::get('/', 'HomeController@index');
    
    // Static menu
    Route::get('in-progress', 'InprogressController@index');
    Route::get('mails-receive', 'ContactController@mailsReceive')->name('mails-receive');
    Route::get('contact', 'ContactController@index')->name('contact');
    Route::post('contact', 'ContactController@store')->name('contact');
    Route::get('about-me', 'HomeController@aboutMe');
    
    // Dynamic menu
    Route::get('{imagesSection}/{imagesProject}', 'ImageController@index');


    