<?php
//namespace App\Providers;
//use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Response;

namespace App\Http\Controllers;
use App\socio;
use PDF;
use App\sociomembresia;
use App\membresia;
use PDF;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\CreateSociosRequest;
use Illuminate\Http\Request;
use DateTime;
//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class sociosController extends Controller
{

    public function show(){
    	 //->where('name', 'John')->value('email');
    	//$socios=DB::table('socios')->where('tipoSocio','=',"Socio Activo");//>paginate(10);
    	
        $estado='Activo';
        $tipoSocio="Socio Activo";
    	$socios=socio::where('tipoSocio','=',"Socio Activo")
        ->where('estado','Activo')->paginate(9);
		//count0($socios);/////no se por que no agarra paginate si pongo all()
    	$count0=count(socio::all()->where('tipoSocio','=',"Socio Activo")->where('estado','Activo'));
    	$count=socio::where('tipoSocio','=','Activo Mayor')->where('estado','Activo')->count();//count($socios);
    	$count2=socio::where('estado','Inactivo')->count();//count($socios);
           
    	 // dd($socios);
    	  
    	   return view('socios.show',[
    		'socios'=> $socios,
    		'tipoSocio'=>$tipoSocio,
    		'count0'=>$count0,
    		'count'=>$count,
    		'count2'=>$count2,
            'estado'=>$estado,
    		]);
    }
    public function showactivoMayor($tipoSocio){//tipo socio solo es la accion de los lados de la vvista
    	if($tipoSocio==1){///ES aactivo
            $estado='Activo';
    		$tipoSocio="Socio Activo";
    		$socios=socio::where('tipoSocio','=',"Socio Activo")
            ->where('estado','Activo')->paginate(9);
    	    //count0($socios);
    	   $count=socio::where('tipoSocio','=','Activo Mayor')->where('estado','Activo')->count();//count($socios);
    	    $count0=count(socio::all()->where('tipoSocio','=',"Socio Activo")->where('estado','Activo'));
    	      $count2=socio::where('estado','Inactivo')->count();//count($socios);
         
        //count($socios);
    	    //dd($socios);  
    	}
    	if($tipoSocio==2){///ES aactivo Mayor
            $estado='Activo';
    		$socios=socio::where('tipoSocio','=',"Activo Mayor")
            ->where('estado','Activo')->paginate(9);
    	    
    		$count=count(socio::all()->where('tipoSocio','=',"Activo Mayor")->where('estado','Activo'));
    	    $tipoSocio="Activo Mayor";
    	    $count0=socio::where('tipoSocio','=','Socio Activo')->where('estado','Activo')->count();//count($socios);
    	    $count2=socio::where('estado','Inactivo')->count();//count($socios);
         //  dd($socios);
    	    //dd($count);  
    	}
        if($tipoSocio==3){///ES aactivo Mayor
            $estado='Inactivo';
            $socios=socio::where('estado','Inactivo')->paginate(9);
            
            $count=count(socio::all()->where('tipoSocio','=',"Activo Mayor")->where('estado','Activo'));
            $tipoSocio="";
            $count0=socio::where('tipoSocio','=','Socio Activo')->where('estado','Activo')->count();//count($socios);
            $count2=socio::where('estado','Inactivo')->count();//count($socios);
         //  dd($socios);
            //dd($count);  
        }
    	return view('socios.show',[
    		'socios'=> $socios,
    		'tipoSocio'=>$tipoSocio,
    		'count0'=>$count0,
    		'count'=>$count,
            'count2'=>$count2,
    		 'estado'=>$estado,
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
            'estado'=>'Activo',
    		]);
        $idsocio=socio::where('dui',$request->input('dui'))->get()->first();//->pluck('id')->get()->first();
        $x=$request->input('fechaNac');
        
       // $date = DateTime::createFromFormat("Y-m-d", $x);
        $date = new DateTime();
        $numeroAnho=$date->format("Y");
       $numeroMes=$date->format("n");
        $pagos=membresia::where('año',$numeroAnho)->get();
		foreach($pagos as $pago)
        {
            $var='CANCELADO';
            //$idsocios=$idsocio->id;
            if($pago->numMes>9){
                $var='PENDIENTE';
            }
            sociomembresia::create([
            'idmembresias'=> $pago->id,
            'idsocios'=> $idsocio->id,
            'fechaPago'=> $request->input('fechaNac'),
            'estado'=>$var,
            ]);
           
        }	
   		 
    	//dd($message);
    	 //$response = socio::create($request->all());	
   		 //dd($response);

        return Response::json($pagos);
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
        ->limit(8)
        ->get();
        if($messages){
            foreach ($messages as $key => $message) {
                if($message->estado=='Activo')
                {
                    $sAc='<td class="text-center">'.
    '<button type="button" class="btn btn-outline-warning btn-sm " value="'.$message->id.'">Pagos</button>  '.                
    '<button type="button" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">'.
    'Info</button> '.
    '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'.$message->id.'">Editar</button> '.
    '<button type="button" class="btn btn-outline-danger btn-sm" value="'.$message->id.'">Dar Baja</button> </td>'.
    '</tr>';
                }else{
            $sAc='<td class="text-center">'.
    '<button type="button" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">'.
    'Info</button> '.
    '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'.$message->id.'">Editar</button> '.
    '<button type="button" class="btn btn-outline-primary btn-sm" value="'.$message->id.'">Dar de Alta</button> </td>'.
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
    public function darBaja($id){
        $socios = socio::find($id);//all()->where('id',"=",$socio_id);
        $socios->fill([
            'estado'=>'Inactivo',
            ]);
        if($socios->save())
            return Response::json('Socio '.$socios->nombre.' '.'Cambio a Inactivo');
            else
                return Response::json('No pudo cambiar');
        //return Response::json('Socio '.$socios->nombre.' '.'Cambio a Inactivo');
    }
    public function darAlta($id){
        $socios = socio::find($id);//all()->where('id',"=",$socio_id);
        $socios->fill([
            'estado'=>'Activo',
            ]);
        if($socios->save())
            return Response::json('Socio '.$socios->nombre.' '.'Cambio a Activo');
            else
                return Response::json('No pudo cambiar');
        //return Response::json('Socio '.$socios->nombre.' '.'Cambio a Inactivo');
    }

    public function sociosPDF(){
        $socios=socio::where('estado','Activo')->get();
        $pdf=PDF::loadVIew('pdf.sociosPDF',[
            'socios'=> $socios,
            ]);
        //return $pdf->download('ejemplo.pdf');
        return $pdf->stream('sociosPDF.pdf');
    }
}
