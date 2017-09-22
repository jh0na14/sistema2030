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

Route::get('/sociospago','sociosPagoController@show');
Route::get('/sociospago/{tipoSocio}','sociosPagoController@showEstado');
Route::get('/sociospago/buscar/{socio_id?}','sociosPagoController@buscar');
Route::get('/sociospago/busqueda/{socio_id?}','sociosPagoController@busqueda');

Route::get('/pagos/{socio_id}','pagosController@show');
Route::get('/pagos/{socio_id}/{anho}','pagosController@showParametros');

Route::get('/periodos','periodosController@show');
Route::get('/periodos/buscar/{id?}','periodosController@buscar');
Route::post('/periodos/create','periodosController@create');
Route::put('/periodos/update/{id?}','periodosController@update');
Route::get('/periodos/busqueda/{texto?}','periodosController@busqueda');
Route::get('/periodos/bus/socios','periodosController@busquedaSelect');
Route::put('/periodos/activar/{id?}','periodosController@activar');
Route::put('/periodos/desactivar/{id?}','periodosController@desactivar');//no la uso 

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
Route::put('/peticiones/update/{id?}','peticionesController@update');
Route::get('/peticiones/busqueda/{texto?}/{semestre}','peticionesController@busqueda');
Route::put('/peticiones/darBaja/{id?}','peticionesController@darBaja');
Route::get('/peticiones/buscar/{id?}','peticionesController@buscar');
Route::get('/peticiones/buscar1/{id?}','peticionesController@buscar1');
Route::get('/peticiones/buscarinfoProyecto/{id?}','peticionesController@buscarinfoProyecto');
Route::get('/peticiones/{estado?}/{semestre?}','peticionesController@showParametros');
Route::post('/peticiones/createProyecto','peticionesController@createProyecto');

Route::get('/proyectos','proyectoController@show');
Route::get('/proyectos/{estado}','proyectoController@showEstado');
Route::get('/proyectos/{estado?}/{semestre?}','proyectoController@showParametros');
Route::post('/proyectos/createDonacion','proyectoController@createDonacion');

Route::get('/donaciones','donacionController@show');
Route::get('/donaciones/{estado}','donacionController@showEstado');

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
Route::get('/verdugo/bus/socios','verdugoController@busquedaSelect');


//Route::get('/socios/1','sociosController@show2');
/*
Route::post('/socios/create',function(Request $request){
	
    $response = socio::create($request->all());
    dd($response);
    return Response::json($response);
});
*/