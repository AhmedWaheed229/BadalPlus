<?php

use Illuminate\Support\Facades\Route;

Route::get('/settings', 'MainController@settings');
Route::get('/welcome', 'MainController@welcome');
Route::get('/welcome_slides', 'MainController@slides');
Route::get('/why_us', 'MainController@whyUs');

Route::get('/categories', 'CategoryController@index');


Route::post('/login', 'AuthController@login');

Route::group(['middleware' => ['auth:api', 'check_active_api']], function() {
    Route::get('/user', 'AuthController@user');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/update-user', 'AuthController@updateUser');
    Route::post('/register','AuthController@register');
});
