<?php
//namespace App\Providers;
//use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Response;

namespace App\Http\Controllers;
use App\socio;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\CreateSociosRequest;
use Illuminate\Http\Request;
//use Illuminate\Foundation\Http\FormRequest;

class sociosController extends Controller
{
    public function show(){
    	 //->where('name', 'John')->value('email');
    	//$socios=DB::table('socios')->where('tipoSocio','=',"Socio Activo");//>paginate(10);
    	$tipoSocio="Socio Activo";
    	$socios=socio::where('tipoSocio','=',"Socio Activo")->paginate(10);
		//count0($socios);/////no se por que no agarra paginate si pongo all()
    	$count0=count(socio::all()->where('tipoSocio','=',"Socio Activo"));
    	$count=socio::where('tipoSocio','=','Activo Mayor')->count();//count($socios);
    	   
    	 // dd($socios);
    	  
    	   return view('socios.show',[
    		'socios'=> $socios,
    		'tipoSocio'=>$tipoSocio,
    		'count0'=>$count0,
    		'count'=>$count,
    		
    		]);
    }
    public function showactivoMayor($tipoSocio){
    	if($tipoSocio==1){///ES aactivo
    		$tipoSocio="Socio Activo";
    		$socios=socio::where('tipoSocio','=',"Socio Activo")->paginate(10);
    	    //count0($socios);
    	
    	    $count0=count(socio::all()->where('tipoSocio','=',"Socio Activo"));
    	    $count=socio::where('tipoSocio','=','Activo Mayor')->count();//count($socios);
    	//count($socios);
    	    //dd($socios);  
    	}
    	if($tipoSocio==2){///ES aactivo Mayor
    		$socios=socio::where('tipoSocio','=',"Activo Mayor")->paginate(10);
    	    
    		$count=count(socio::all()->where('tipoSocio','=',"Activo Mayor"));
    	    $tipoSocio="Activo Mayor";
    	    $count0=socio::where('tipoSocio','=','Socio Activo')->count();//count($socios);
    	 //  dd($socios);
    	    //dd($count);  
    	}
    	return view('socios.show',[
    		'socios'=> $socios,
    		'tipoSocio'=>$tipoSocio,
    		'count0'=>$count0,
    		'count'=>$count,
    		
    		]);
    	
    }

    public function create(CreateSociosRequest $request){
    	//dd($request->all());
    	$message= socio::create([
    		'nombre'=> $request->input('nombre'),
    		'apellido'=> $request->input('apellido'),
    		'fechaNac'=> $request->input('fechaNac'),
    		'dui'=> $request->input('dui'),
    		'direccion'=> $request->input('direccion'),
    		'telefono'=> $request->input('telefono'),
    		'email'=> $request->input('email'),
    		'apodo'=> $request->input('apodo'),
    		'tipoSocio'=> $request->input('tipoSocio'),
    		'cargo'=> $request->input('cargo'),
    		
    		]);
		//$response = socio::create($request->all());	
   		 
    	//dd($message);
    	 //$response = socio::create($request->all());	
   		 //dd($response);
    	return Response::json($message);
    	
    	
    	return redirect('/socios')->with('mensaje','Registro Guardado');

    }
    public function update(CreateSociosRequest $request,$socio_id){
    	//dd($request->all());
    	$socios = socio::find($socio_id);//all()->where('id',"=",$socio_id);
    	 $socios->fill($request->all());
    	$socios->save();
    	//dd($socios);
	//$array=array();
    //dd($socio);
	//foreach($socio as $socios)
	//{
	/*	$socios->nombre=$request->nombre;
		$socios->apellido=$request->apellido;
		$socios->fechaNac=$request->fechaNac;
    	$socios->dui=$request->dui;
   		$socios->direccion=$request->direccion;
   		$socios->telefono=$request->telefono;
   		$socios->email=$request->email;
   		$socios->apodo=$request->apodo;
   		$socios->tipoSocio=$request->tipoSocio;
   		$socios->cargo=$request->cargo;
   		
		

	//}*/
		//dd($socios);
		////////////return redirect('/socios');
		return Response::json($socios);
    	//return response(json($array));
    	
    	

    }
}
