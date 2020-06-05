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



// user 
Route::group(['prefix' => 'user'], function ( ) {
    Route::post('registrar',   'UserController@create');
    Route::post('login',       'UserController@login');
});


// avistamientos
Route::group(['prefix' => 'avistamientos'], function ( ) {
    Route::get('admin-listar',   'AvistamientoController@index');
    Route::get('user-listar',    'AvistamientoController@user_index');
    Route::post('registrar',     'AvistamientoController@create');
    Route::post('actualizar',    'AvistamientoController@actualizar');
});
