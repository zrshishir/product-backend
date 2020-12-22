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

Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');


Route::group(['middleware' => ['jwt.verify']], function() {
    // product
    Route::get('product', 'App\Http\Controllers\ProductController@index');
    Route::post('product', 'App\Http\Controllers\ProductController@store');
    Route::delete('product/{id}', 'App\Http\Controllers\ProductController@destroy');
});

