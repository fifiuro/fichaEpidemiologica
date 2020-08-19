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

Route::get('welcome', function(){
  return view('welcome');
});

Route::get('/', function () {
    return view('template.inicio');
});

Route::get('nuevo', 'FichaEpidemiologicaController@create');
Route::post('nuevo','FichaEpidemiologicaController@store');

Route::get('pantalla_imprimir/{id}','FichaEpidemiologicaController@pantalla_imprimir');
Route::get('imprimir/{id}','FichaEpidemiologicaController@imprimir');

Route::get('buscar','FichaEpidemiologicaController@index');
Route::post('buscar','FichaEpidemiologicaController@show');

//Route::name('imprimir')->get('imprimir','FichaEpidemiologicaController@imprimir');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
