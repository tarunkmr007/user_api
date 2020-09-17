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


Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::post('logout', 'API\UserController@logout');
        Route::post('update','API\UserController@update');
        // Route::get('user', 'AuthController@user');
    });
