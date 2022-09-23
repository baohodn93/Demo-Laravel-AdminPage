<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Frontend Route
Route::get('/','Front\FrontController@home');
// Subcribe Route
Route::post('/sign-up-to-promotions','Front\FrontController@subEmail');

// BackEnd Route
//welcome to admin
Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'auth'], 'namespace' => 'admin'], function () {
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    //Staff management
    Route::group(['prefix' => 'staff'], function () {
        Route::get('/profile', 'AdminController@staff_profile');
        Route::post('/profile', 'AdminController@staff_update');
        Route::get('/list', 'AdminController@staff_list');
        // Route::get('/add', 'AdminController@staff_add');
        Route::post('/add', 'AdminController@staff_add_post');
        Route::get('/edit/{id}', 'AdminController@staff_edit');
        Route::post('/edit/{id}', 'AdminController@staff_edit_post');
        Route::get('/delete/{id}', 'AdminController@destroy');
        Route::get('/csv-export', 'AdminController@csvExport');
    });
    //System management
    Route::get('/system', 'SystemController@getInfoSystem');
    Route::post('/system', 'SystemController@updateSystem');

    //Page management
    Route::group(['prefix' => 'page'], function () {
        Route::get('/list', 'PageController@page_list');
        Route::get('/edit/{id}', 'PageController@page_edit');
        Route::post('/edit/{id}', 'PageController@page_edit_post');
    });
    //Social management
    Route::group(['prefix' => 'social'], function () {
        Route::get('/list', 'SocialController@social_list');
        Route::post('/add', 'SocialController@social_add_post');
        Route::get('/edit/{id}', 'SocialController@social_edit');
        Route::post('/edit/{id}', 'SocialController@social_edit_post');
    });
    //Slider management
    Route::group(['prefix' => 'slider'], function () {
        Route::get('/list', 'SliderController@slider_list');
        Route::post('/add', 'SliderController@slider_add_post');
        Route::get('/edit/{id}', 'SliderController@slider_edit');
        Route::post('/edit/{id}', 'SliderController@slider_edit_post');
        Route::get('/delete/{id}', 'SliderController@destroy');
    });
    //News catalogue management
    Route::group(['prefix' => 'news'], function () {
        Route::get('/cat_list', 'NewsController@news_cat_list');
        Route::get('/cat_edit/{id}', 'NewsController@news_cat_edit');
        Route::post('/cat_edit/{id}', 'NewsController@news_edit_cat_post');
        Route::get('/list', 'NewsController@news_list');
        Route::get('/edit/{id}', 'NewsController@news_edit');
        Route::get('/add', 'NewsController@news_add');
        Route::post('/add', 'NewsController@news_add_post');
        Route::get('/edit/{id}', 'NewsController@news_edit');
        Route::post('/edit/{id}', 'NewsController@news_edit_post');
        Route::get('/delete/{id}', 'NewsController@destroy');
    });
    //Promotion management
    Route::group(['prefix' => 'promotion'], function () {
        Route::get('/list', 'PromotionController@promotion_list');
        Route::get('/edit/{id}', 'PromotionController@promotion_edit');
        Route::post('/edit/{id}', 'PromotionController@promotion_edit_post');
        Route::get('/delete/{id}', 'PromotionController@destroy');
    });
    //Contact management
    Route::group(['prefix' => 'contact'], function () {
        Route::get('/list', 'ContactController@contact_list');
        Route::get('/edit/{id}', 'ContactController@contact_edit');
        Route::post('/edit/{id}', 'ContactController@contact_edit_post');
        Route::get('/delete/{id}', 'ContactController@destroy');
    });
});
//welcome to user
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'user'], function () {
    Route::get('/dashboard', 'UserController@index')->name('user.dashboard');

    //User management
    Route::group(['prefix' => 'profile'], function () {
        Route::get('/edit', 'UserController@profile_edit');
        Route::post('/edit/{id}', 'UserController@profile_edit_post');
    });
});
