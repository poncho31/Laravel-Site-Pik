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

Auth::routes();
// Route::get('logout', 'Auth\LoginController@logout', function () {
//     return abort(404);
// });
Route::get('/', 'homeController@index');

// Admin menu
Route::middleware('auth')->group(function () {
    // dd($_REQUEST);
    Route::resource('image', 'ImageController');
});

// Static menu
Route::get('contact', 'homeController@contact')->name('contact');
Route::get('about-me', 'homeController@aboutMe');
Route::get('in-progress', 'homeController@inProgress');

// Dynamic menu
Route::get('{imagesSection}/{imagesProject}', 'ImageController@index');

