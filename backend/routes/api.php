<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/local', 'AuthController@login');
Route::post('register/local', 'AuthController@register');
Route::post('logout/local', 'AuthController@logout');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('/user/me', 'UserController@getUser');
    Route::get('/user/profile/{alias}', 'UserController@getProfile');
    Route::get('/user/posts', 'UserController@getHomePosts');
    Route::post('/user/like', 'UserController@createLike');
    Route::post('/user/image', 'UserController@updateProfileImage');
    Route::delete('/user/like/{postId}', 'UserController@deleteLike');
    Route::put('/user/friend-request', 'UserController@updateFriendRequest');
    Route::put('/user/notify-likes-viewed', 'UserController@updateLikesViewed');
    Route::get('/user/search/{value}', 'UserController@searchUsersByAlias');
});
