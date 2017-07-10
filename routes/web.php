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
Route::put('/socios/update/{socio_id}','sociosController@update');

Route::get('/socios/buscar/{socio_id}',function($socio_id){
    //dd($socio_id);
    $socio = socio::all()->where('idsocios',"=",$socio_id);//find($socio_id);
    //console.log($socio);
	//dd($socio);
	//$socios=$socio.getarr;
	$array=array();
	foreach($socio as $socios)
	{
		$array=[
		'nombre'=>$socios->nombre,
		'apellido'=>$socios->apellido,
		'fechaNac'=>$socios->fechaNac,
    	'dui'=> $socios->dui,
   		'direccion'=> $socios->direccion,
   		'telefono'=> $socios->telefono,
   		'email'=> $socios->email,
   		'apodo'=> $socios->apodo,
   		'tipoSocio'=>$socios->tipoSocio,
   		'cargo'=> $socios->cargo
		];
		
		

	}
    return Response::json($array);
});

//Route::get('/socios/1','sociosController@show2');
/*
Route::post('/socios/create',function(Request $request){
	
    $response = socio::create($request->all());
    dd($response);
    return Response::json($response);
});
*/