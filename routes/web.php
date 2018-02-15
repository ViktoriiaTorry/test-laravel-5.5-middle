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
Route::group(['middleware' => 'auth'], function () {
    Route::match(['get', 'post'], '/', 'HomeController@index')->name('home');
    Route::get('/profile/{id}', 'ProfileController@index')->name('profile');
    Route::get('profile/{id}/follow', 'ProfileController@followUser')->name('user.follow');
    Route::get('/{profileId}/unfollow', 'ProfileController@unFollowUser')->name('user.unfollow');
    Route::match(['get', 'post'],'/post/add', 'HomeController@addPost')->name('post.add');
    Route::get('/posts/popular', 'HomeController@showPopular')->name('post.popular');
});
Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');

