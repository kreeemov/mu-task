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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

    //   User Frontend
Route::get('/profile', 'UserController@index')->name('profile')->middleware('auth');

Route::post('/profile/update-gender', 'UserController@updateGender')->name('update-gender');


Route::get('/posts/delete/{id}', 'PostController@delete')->name('deletePost');

Route::resource('posts', 'PostController')->middleware('checkGender');
Route::resource('comments', 'CommentController')->middleware('checkGender');



Route::get('auth/facebook', 'Auth\FacebookController@redirectToFacebook');
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleFacebookCallback');
