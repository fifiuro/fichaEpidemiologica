<?php

use Illuminate\Support\Facades\Route;

use App\Exports\DiagnosticoExport;


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

/** FICHA EPIDEMIOLOGICA */
Route::group(['prefix' => 'ficha'], function(){
  Route::get('buscar','FichaEpidemiologicaController@index');
  Route::post('buscar','FichaEpidemiologicaController@show');
  Route::get('nuevo', 'FichaEpidemiologicaController@create');
  Route::post('nuevo','FichaEpidemiologicaController@store');
  Route::get('confirm/{id}','FichaEpidemiologicaController@confirm');
  Route::post('eliminar','FichaEpidemiologicaController@destroy');
});
/** FIN */

/** LABORATORIO */
Route::group(['prefix' => 'laboratorio'], function(){
  Route::get('buscar/{id}','LaboratorioController@index');
  Route::post('buscar','LaboratorioController@show');
  Route::get('nuevo/{id}','LaboratorioController@create');
  Route::post('nuevo','LaboratorioController@store');
  Route::get('editar/{id}','LaboratorioController@edit');
  Route::post('actualizar','LaboratorioController@update');
  Route::get('confirma/{id}','LaboratorioController@confirm');
  Route::get('eliminar','LaboratorioController@destroy');
});
/** FIN */

/** IMPRIMIR FICHA EPIDEMIOLOGICA */
Route::get('imprimir/{id}','FichaEpidemiologicaController@imprimir');
/** FIN */

/** IMPRIMIR CERTIFICADO DE LABORATORIO */
Route::get('certificado/{id}/{lab}','FichaEpidemiologicaController@certificado');
/** FIN */

/** IMPRIMIR CERTIFICADO MEDICO */
Route::get('certificado_medico/{id}','FichaEpidemiologicaController@certificado_medico');

/* Route::get('pantalla_imprimir/{id}','FichaEpidemiologicaController@pantalla_imprimir'); */


Route::get('resultado','ReporteController@resultado');
Route::post('resultado','ReporteController@resultado_show');

Route::get('excel',function(){
  return Excel::download(new DiagnosticoExport, 'diagnostico.xlsx');
});

//Route::name('imprimir')->get('imprimir','FichaEpidemiologicaController@imprimir');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
