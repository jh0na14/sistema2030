<?php

namespace App\Http\Controllers;
use App\donacion;
use App\peticion;
use App\periodo;
use App\proyecto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\createDonacionRequest;
use App\Http\Requests\createProyectosRequest;

class donacionController extends Controller
{
    //
    public function show(){   
    	$tipo='Realizada';
      ////id periodo actual
        $idperiodo=periodo::where('estado','iniciado')->get()->first();//->pluck('id')->get()->first();
        $donacion=donacion::where('tipo','Realizada')
        ->where('idperiodos',$idperiodo->id)->paginate(8);
      
      ////muestra los priodos para seleccionarlos 
        $periodos=periodo::latest()->get();  
        //return Response::json($periodo);
           return view('donaciones.showDonacion',[
            'donaciones'=> $donacion,
            'tipo'=>$tipo,
            'periodos'=>$periodos,
            'periodoActual'=>$idperiodo->semestre,
            ]);
    }
    public function showEstado($estado){
      if($estado=='Recibidas'){
        $tipo='Recibida';  
        $periodos=periodo::latest()->get();   
        $idperiodo=periodo::where('estado','iniciado')->get()->first();
        $donacion =DB::table('donacions')
          ->join('patrocinadors', 'donacions.idpatrocinadors', '=', 'patrocinadors.id')
          ->select('donacions.*',
            'patrocinadors.nombre'
            )
          ->where('donacions.tipo','Recibida')
          ->where('donacions.idperiodos',$idperiodo->id)
          ->paginate(8);
       /* $proyecto=proyecto::where('estado','Cancelado')
        ->where('idperiodos',$idperiodo->id)->paginate(8);
         */
           }

           return view('donaciones.showDonacion',[
            'donaciones'=> $donacion,
            'tipo'=>$tipo,
            'periodos'=>$periodos,
            'periodoActual'=>$idperiodo->semestre,
            ]);
    }

    public function showParametros($estado,$semestre){   
     if($estado=='Programado'){
        //$estado='Disponible';   
        //erdiodo activo o iniciado no se o del pluck me da problema aca
        $idperiodo=periodo::where('semestre',$semestre)->get()->first();//->pluck('id')->get()->first();
         $proyecto =DB::table('proyectos')
          ->join('peticions', 'proyectos.idpeticions', '=', 'peticions.id')
          ->select('proyectos.*',
            'peticions.descripcion',
            'peticions.id as peticionID'
            )
          //->select()
          ->where('proyectos.estado','Programado')
          ->where('proyectos.idperiodos',$idperiodo->id)
          ->paginate(8);$periodos=periodo::latest()->get();  
       // $periodos=periodo::where('id',$idperiodo)->get(); 
       
     }elseif($estado=='SinFinalizar'){//para que no aparezca en navegador Sin%20Finalizar
        $estado='Cancelado';   
        //erdiodo activo o iniciado
        $idperiodo=periodo::where('semestre',$semestre)->get()->first();
         $proyecto =DB::table('proyectos')
          ->join('peticions', 'proyectos.idpeticions', '=', 'peticions.id')
          ->select('proyectos.*',
            'peticions.descripcion',
            'peticions.id as peticionID'
            )
          //->select()
          ->where('proyectos.estado','Cancelado')
          ->where('proyectos.idperiodos',$idperiodo->id)
          ->paginate(8);
       /* $proyecto=proyecto::where('estado','Cancelado')
        ->where('idperiodos',$idperiodo->id)->paginate(8);
        */$periodos=periodo::latest()->get();  
           
     }else if($estado=='Finalizado'){
        //$estado='Finalizado';
            //erdiodo activo o iniciado
            $idperiodo=periodo::where('semestre',$semestre)->get()->first();
            $proyecto =DB::table('proyectos')
          ->join('peticions', 'proyectos.idpeticions', '=', 'peticions.id')
          ->select('proyectos.*',
            'peticions.descripcion',
            'peticions.id as peticionID'
            )
          //->select()
          ->where('proyectos.estado','Finalizado')
          ->where('proyectos.idperiodos',$idperiodo->id)
          ->paginate(8);
            $periodos=periodo::latest()->get();  
         
      }
           return view('proyectos.showProyecto',[
            'proyectos'=> $proyecto,
            'estado'=>$estado,
            'periodos'=>$periodos,
            'periodoActual'=>$idperiodo->semestre,
            ]);  
         }//fin sowParametro




    
}
