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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::get('me', 'App\Http\Controllers\AuthController@me');
    Route::post('register', 'App\Http\Controllers\AuthController@register');
    Route::put('users/{user}', 'App\Http\Controllers\AuthController@update');
    Route::delete('users/{user}', 'App\Http\Controllers\AuthController@destroy');



});

Route::group([

    'middleware' => 'api',
    'prefix' => 'posts'

], function ($router) {

    Route::get('all', 'App\Http\Controllers\PostsController@index'); //mostrar todos los posts
    Route::get('{post}', 'App\Http\Controllers\PostsController@show'); //traer un post escpecifico
    Route::put('update/{post}', 'App\Http\Controllers\PostsController@update'); //editar
    Route::post('new', 'App\Http\Controllers\PostsController@store'); //crear nuevo post

    Route::delete('delete/{post}', 'App\Http\Controllers\PostsController@destroy'); //borrar un post



});

