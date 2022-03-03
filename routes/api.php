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

Route::apiResource('usuarios', 'Usuario\UsuarioController');
Route::apiResource('usuarios.libros', 'Usuario\UsuarioLibroController', ['only' => ['index']]);
Route::apiResource('libros', 'Libro\LibroController');
Route::apiResource('libros.usuarios', 'Libro\LibroUsuarioController', ['only' => ['index']]);
Route::apiResource('prestamos', 'Prestamo\PrestamoController', ['only' => ['index', 'show', 'store', 'destroy']]);


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'JWTAuthController@register');
    Route::post('login', 'JWTAuthController@login')->name('login');
    Route::post('logout', 'JWTAuthController@logout')->name('logout');
    Route::post('refresh', 'JWTAuthController@refresh');
    Route::get('profile', 'JWTAuthController@profile');

});