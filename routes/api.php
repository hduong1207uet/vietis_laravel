<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1'], function() {
    Route::resource('posts', 'PostsController');
});

//
// Route::group(['prefix' => 'v1', 'namespace' => 'Api\v1\NuxtAuth'], function () {
//     Route::post('nuxtauth/register', 'AuthController@register')->name('register');
//     Route::post('nuxtauth/login', 'AuthController@login')->name('login');

//     Route::group(['middleware' => 'auth:api'], function () {
//         Route::post('nuxtauth/logout', 'AuthController@logout')->name('logout');
//         Route::get('nuxtauth/user', 'AuthController@me')->name('me');
//     });
// });
