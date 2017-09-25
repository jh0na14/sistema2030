<?php
//namespace App\Providers;
//use Illuminate\Support\ServiceProvider;
//use Illuminate\Support\Facades\Response;

namespace App\Http\Controllers;
use App\socio;
use App\sociomembresia;
use App\membresia;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\CreateSociosRequest;
use Illuminate\Http\Request;
use DateTime;
//use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class sociosPagoController extends Controller
{

    public static function verDeuda($idsocios){
        $sum=0.00;
        $date = new DateTime();
        $numeroAnho=$date->format("Y");
        $numeroMes=$date->format("n");
         $messages=DB::table('sociomembresias')
         ->join('membresias', 'sociomembresias.idmembresias', '=', 'membresias.id')
          ->select('sociomembresias.*',
            'membresias.monto'
            )
          //->select()
          ->where('sociomembresias.idsocios',$idsocios)
          ->where('sociomembresias.estado','PENDIENTE')
          ->where('membresias.año','<=' ,$numeroAnho)
          ->where('membresias.numMes','<=',$numeroMes)
          //->paginate(8)
          ->get();
          foreach ($messages as $message  ) {
             $sum=$sum+$message->monto;
          }
          //return Response::json($message);
          if($sum==0){
            return 'SOLVENTE';
          }
        return  '$ '.number_format($sum, 2);
    }

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
    	  
    	   return view('socios.showDeuda',[
    		'socios'=> $socios,
    		'tipoSocio'=>$tipoSocio,
    		'count0'=>$count0,
    		'count'=>$count,
    		'count2'=>$count2,
            'estado'=>$estado,
    		]);
    }
    public function showEstado($tipoSocio){//tipo socio solo es la accion de los lados de la vvista
    	if($tipoSocio==1){///ES aactivo
            $estado='Activo';
    		$tipoSocio="Socio Activo";
    		$socios=socio::where('tipoSocio','=',"Socio Activo")
            ->where('estado','Activo')->paginate(9);
    	    //count0($socios);
    	   $count=socio::where('tipoSocio','=','Activo Mayor')->where('estado','Activo')->count();//count($socios);
    	    $count0=count(socio::all()->where('tipoSocio','=',"Socio Activo")->where('estado','Activo'));
    	      $count2=socio::where('estado','Inactivo')->count();//count($socios); 
    	}
    	if($tipoSocio==2){///ES aactivo Mayor
            $estado='Activo';//ver esto
    		$socios=socio::where('tipoSocio','=',"Activo Mayor")
            ->where('estado','Activo')->paginate(9);
    	    
    		$count=count(socio::all()->where('tipoSocio','=',"Activo Mayor")->where('estado','Activo'));
    	    $tipoSocio="Activo Mayor";
    	    $count0=socio::where('tipoSocio','=','Socio Activo')->where('estado','Activo')->count();//count($socios);
    	    $count2=socio::where('estado','Inactivo')->count();//count($socios);
        }
        
    	return view('socios.showDeuda',[
    		'socios'=> $socios,
    		'tipoSocio'=>$tipoSocio,
    		'count0'=>$count0,
    		'count'=>$count,
            'count2'=>$count2,
    		 'estado'=>$estado,
    		]);
    	
    }

    public function buscar($socio_id){
    $socio = socio::find($socio_id);//all()->where('idsocios',"=",$socio_id);//find($socio_id);
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
     '</tr>';
                }
               $output.='<tr>'.
                        '<td>'.$message->apodo.'</td>'.
                        '<td>'.$message->nombre.
                        ' '.$message->apellido.'</td>'.
                        '<td>'.$message->email.'</td>'.
                        '<td style="font-size:14px" class="text-center">'.sociosPagoController::verDeuda($message->id).'</td>';
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
