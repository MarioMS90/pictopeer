<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/local', 'AuthController@login');
Route::post('register/local', 'AuthController@register');
Route::post('logout/local', 'AuthController@logout');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('/user/me', 'UserController@getUser');
    Route::get('/user/posts', 'UserController@getPosts');
});
