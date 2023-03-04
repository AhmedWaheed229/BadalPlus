<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/browse', 'HomeController@browse')->name('browse');
Route::get('/get-sub-categoris', 'HomeController@getSubCategoris')->name('web.getSubCategoris');

// Route::get('test', function () {
//     try {
//         $event = event(new App\Events\PusherNotification('hello'));
//         return $event;
//     } catch (Exception $th) {
//         return $th;
//     }
// });
Route::get('test', function () {
    event(new App\Events\PusherNotification('Monika'));
    return "Event has been sent!";
});
Route::get('test1', function () {
    return view('test');
});
