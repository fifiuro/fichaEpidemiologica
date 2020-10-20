<?php

use Illuminate\Support\Facades\Route;

use App\Exports\DiagnosticoExport;
use App\PersonalNotifica;


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

Route::get('/', function(){
  return view('auth.login');
});

Route::get('home', function () {
  $usu = PersonalNotifica::where('id','=',Auth::user()->id)
                         ->select('nombre_notifica','paterno_notifica','materno_notifica')
                         ->get();
  return view('template.inicio')->with('usu',$usu);
})->middleware('auth');

/** FICHA EPIDEMIOLOGICA */
Route::group(['prefix' => 'ficha', 'middleware' => ['auth']], function(){
  Route::get('buscar','FichaEpidemiologicaController@index');
  Route::post('buscar','FichaEpidemiologicaController@show');
  Route::get('nuevo', 'FichaEpidemiologicaController@create');
  Route::post('nuevo','FichaEpidemiologicaController@store');
  Route::get('editar/{id}/{ci}/{fecha}/{id_est}','FichaEpidemiologicaController@edit');
  Route::post('actualizar','FichaEpidemiologicaController@update');
  Route::get('confirm/{id}','FichaEpidemiologicaController@confirm');
  Route::post('eliminar','FichaEpidemiologicaController@destroy');
});
/** FIN */

/** LABORATORIO */
Route::group(['prefix' => 'laboratorio', 'middleware' => ['auth']], function(){
  Route::get('buscar/{id}','LaboratorioController@index');
  Route::post('buscar','LaboratorioController@show');
  Route::get('nuevo/{id}','LaboratorioController@create');
  Route::post('nuevo','LaboratorioController@store');
  Route::get('editar/{id}/{ci}/{fecha}/{id_est}','LaboratorioController@edit');
  Route::post('actualizar','LaboratorioController@update');
  Route::get('confirma/{id}','LaboratorioController@confirm');
  Route::get('eliminar','LaboratorioController@destroy');
});
/** FIN */

/** IMPRIMIR FICHA EPIDEMIOLOGICA */
Route::get('imprimir/{id}/{ci}/{fecha}/{id_est}','FichaEpidemiologicaController@imprimir');
/** FIN */

/** IMPRIMIR CERTIFICADO DE LABORATORIO */
Route::get('certificado/{id}/{lab}/{ci}/{fecha}','FichaEpidemiologicaController@certificado');
/** FIN */

/** IMPRIMIR CERTIFICADO MEDICO */
Route::get('certificado_medico/{id}/{ci}/{fecha}','FichaEpidemiologicaController@certificado_medico');

/* Route::get('pantalla_imprimir/{id}','FichaEpidemiologicaController@pantalla_imprimir'); */


Route::get('resultado','ReporteController@resultado');
Route::post('resultado','ReporteController@resultado_show');

Route::get('excel',function(){
  return Excel::download(new DiagnosticoExport, 'diagnostico.xlsx');
});

//Route::name('imprimir')->get('imprimir','FichaEpidemiologicaController@imprimir');

Auth::routes(["register" => false, "reset" => false]);

//Route::get('/home', 'HomeController@index')->name('home');
