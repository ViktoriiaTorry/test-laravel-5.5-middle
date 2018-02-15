<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
// get list of users
    Route::get('users', 'Api\UserController@index');
// get specific user
    Route::get('user/{id}', 'Api\UserController@show');
// delete a user
    Route::delete('user/{id}', 'Api\UserController@destroy');
// update existing user
    Route::put('user', 'Api\UserController@store');
// create new user
    Route::post('user', 'Api\UserController@store');

    // get list of posts
    Route::get('posts', 'Api\PostController@index');
// get specific post
    Route::get('post/{id}', 'Api\PostController@show');
// delete a post
    Route::delete('post/{id}', 'Api\PostController@destroy');
// update existing post
    Route::put('post', 'Api\PostController@store');
// create new post
    Route::post('post', 'Api\PostController@store');

    // get list of comments
    Route::get('comments', 'Api\CommentController@index');
// get specific comment
    Route::get('comment/{id}', 'Api\CommentController@show');
// delete a comment
    Route::delete('comment/{id}', 'Api\CommentController@destroy');
// update existing comment
    Route::put('comment', 'Api\CommentController@store');
// create new comment
    Route::post('comment', 'Api\CommentController@store');
});
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
