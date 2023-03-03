<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'check_active']], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['middleware' => ['check_admin']], function () {
        Route::get('/settings', 'SettingController@index')->name('settings.index');
        Route::put('/settings/{id}', 'SettingController@update')->name('settings.update');
        Route::resource('/welcomes', 'WelcomeController');
        Route::resource('/slides', 'SlideController');
        Route::resource('/slide_lists', 'SlideListController');
        Route::resource('/categories', 'CategoryController');
        Route::resource('/why_us', 'WhyusController');
        Route::resource('/currencies', 'CurrenciesController');
        Route::resource('/cash','VfCashController');

        Route::get('/posts/activate/{id}', 'PostController@activate')->name("posts.activate");
        Route::get('/posts/inactivate/{id}', 'PostController@inActivate')->name("posts.inactivate");
        Route::get('/posts/pending/{id}', 'PostController@pending')->name("posts.pending");


        Route::get('/recharge-requests', 'UserController@rechargeRequests')->name('recharge_requests');
        Route::post('/recharge-requests/{id}', 'UserController@updateRechargeRequests')->name('update_recharge_requests');

    });
    Route::get('/sub-categories', 'CategoryController@subCategories')->name('sub_categories');
    Route::resource('/posts', 'PostController');

    Route::resource('/users', 'UserController');

    Route::get('/profile/{id}', 'UserController@profile')->name('profile');

    Route::get('/update-profile', 'UserController@updateProfile')->name('update_profile');
    Route::post('/update-profile', 'UserController@updateUserProfile')->name('update_user_profile');

    Route::get('/wallet', 'UserController@wallet')->name('wallet');
    Route::get('/add-balance', 'UserController@addBalance')->name('add_balance');
    Route::post('/recharge-request', 'UserController@rechargeRequest')->name('recharge_request');

    Route::get('/post/{id}', 'PostController@show')->name('post.show');

});
