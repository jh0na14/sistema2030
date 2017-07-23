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
    	$socios=socio::where('tipoSocio','=',"Socio Activo")->paginate(9);
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
    		$socios=socio::where('tipoSocio','=',"Socio Activo")->paginate(9);
    	    //count0($socios);
    	
    	    $count0=count(socio::all()->where('tipoSocio','=',"Socio Activo"));
    	    $count=socio::where('tipoSocio','=','Activo Mayor')->count();//count($socios);
    	//count($socios);
    	    //dd($socios);  
    	}
    	if($tipoSocio==2){///ES aactivo Mayor
    		$socios=socio::where('tipoSocio','=',"Activo Mayor")->paginate(9);
    	    
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

    public function buscar($socio_id){
        //dd($socio_id);
    $socio = socio::find($socio_id);//all()->where('idsocios',"=",$socio_id);//find($socio_id);
    //console.log($socio);
    //dd($socio);
    
    /*$array=array();
    //If uso asi que no sirve ahora porq antes ocupaba idsocios en ves de id
    $socio = socio::all()->where('idsocios',"=",$socio_id);
    //tengo que hacer esto
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
    }*/
    return Response::json($socio);

    } 

    public function busqueda($texto){
        $output="";
        $messages=socio::where('nombre','like','%'.$texto.'%')
        ->orWhere('email','like','%'.$texto.'%')
        ->orWhere('apodo','like','%'.$texto.'%')
        ->get();
        if($messages){
            foreach ($messages as $key => $message) {
                if($message->tipoSocio=='Socio Activo')
                {
                    $sAc='<td class="text-center">'.
    '<button type="button" class="btn btn-outline-warning btn-sm " value="'.$message->id.'">Pagos</button>  '.                
    '<button type="button" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">'.
    'Info</button> '.
    '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'.$message->id.'">Editar</button> </td>'.
    '</tr>';
                }else{
            $sAc='<td class="text-center">'.
    '<button type="button" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">'.
    'Info</button> '.
    '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'.$message->id.'">Editar</button> </td>'.
    '</tr>';    }
                $output.='<tr>'.
                        '<td>'.$message->apodo.'</td>'.
                        '<td>'.$message->nombre.
                        ' '.$message->apellido.'</td>'.
                        '<td>'.$message->email.'</td>'.
                        '<td>'.$message->cargo.'</td>';
                $output.=$sAc;        
   /* '<td class="text-center">'.
    '<button type="button" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">'.
    'Info</button> '.
    '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'.$message->id.'">Editar</button> </td>'.
    '</tr>';
     */       }
            return Response::json($output);
        }
            return Response::json($messages);
        
    }

}
