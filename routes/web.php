<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/browse', 'HomeController@browse')->name('browse');
Route::get('/get-sub-categoris', 'HomeController@getSubCategoris')->name('web.getSubCategoris');

Route::get('test', function () {

    $event = event(new App\Events\PusherNotification('hello'));
    return $event;
});
