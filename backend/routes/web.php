<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/','PictopeerController@index');

    Route::get('/pictopeer/home', 'PictopeerController@index')->name('home');

    Route::get('/pictopeer/profile', 'PictopeerController@profile')->name('profile');

    Route::get('/pictopeer/profile/{alias}', 'PictopeerController@profileUser')->name('profile.user');
});

Auth::routes();
