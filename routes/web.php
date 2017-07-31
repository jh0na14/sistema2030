<?php

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
use Illuminate\Http\Request;
use App\socio;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return view('ejemplo');
});
Route::get('/socios','sociosController@show');
Route::get('/socios/{tipoSocio}','sociosController@showactivoMayor');
Route::post('/socios/create','sociosController@create');
Route::put('/socios/update/{socio_id?}','sociosController@update');
Route::get('/socios/buscar/{socio_id?}','sociosController@buscar');
Route::get('/socios/busqueda/{socio_id?}','sociosController@busqueda');
Route::put('/socios/darBaja/{id?}','sociosController@darBaja');
Route::put('/socios/darAlta/{id?}','sociosController@darAlta');

Route::get('/beneficiarios','beneficiariosController@show');
Route::get('/beneficiarios/buscar/{id?}','beneficiariosController@buscar');
Route::post('/beneficiarios/create','beneficiariosController@create');
Route::put('/beneficiarios/update/{id?}','beneficiariosController@update');
Route::get('/beneficiarios/busqueda/{texto?}','beneficiariosController@busqueda');

Route::get('/solicitantes','solicitantesController@show');
Route::get('/solicitantes/buscar/{id?}','solicitantesController@buscar');
Route::post('/solicitantes/create','solicitantesController@create');
Route::put('/solicitantes/update/{id?}','solicitantesController@update');
Route::get('/solicitantes/busqueda/{texto?}','solicitantesController@busqueda');
Route::get('/solicitantes/bus/beneficiarios','solicitantesController@busquedaSelect');
Route::post('/solicitantes/createPeticion','solicitantesController@createPeticion');


Route::get('/peticiones','peticionesController@show');
Route::get('/peticiones/{estado}','peticionesController@showEstado');
Route::get('/peticiones/busqueda/{texto?}','peticionesController@busqueda');
Route::put('/peticiones/darBaja/{id?}','peticionesController@darBaja');
Route::get('/peticiones/buscar/{id?}','peticionesController@buscar');

Route::get('/patrocinador','patrocinadorController@show');
Route::get('/patrocinador/buscar/{id?}','patrocinadorController@buscar');
Route::post('/patrocinador/create','patrocinadorController@create');
Route::put('/patrocinador/update/{id?}','patrocinadorController@update');
Route::get('/patrocinador/busqueda/{texto?}','patrocinadorController@busqueda');


Route::get('/verdugo','verdugoController@show');
Route::get('/verdugo/buscar/{id?}','verdugoController@buscar');
Route::post('/verdugo/create','verdugoController@create');
Route::put('/verdugo/update/{id?}','verdugoController@update');
Route::get('/verdugo/busqueda/{texto?}','verdugoController@busqueda');

//Route::get('/socios/1','sociosController@show2');
/*
Route::post('/socios/create',function(Request $request){
	
    $response = socio::create($request->all());
    dd($response);
    return Response::json($response);
});
*/