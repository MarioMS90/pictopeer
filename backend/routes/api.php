<?php

use Illuminate\Support\Facades\Route;

Route::post('auth/local', 'AuthController@login');
Route::post('register/local', 'AuthController@register');
Route::post('logout/local', 'AuthController@logout');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('/users/me', 'UserController@getUser');
    Route::get('/postSuggestions/{page}', 'UserController@getPostSuggestions');
});
