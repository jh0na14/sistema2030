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

class proyectoController extends Controller
{
    //
    public function show(){   
    	$estado='Programado';
      ////id periodo actual
        $idperiodo=periodo::where('estado','iniciado')->get()->first();//->pluck('id')->get()->first();
       $proyecto =DB::table('proyectos')
          ->join('peticions', 'proyectos.idpeticions', '=', 'peticions.id')
          ->select('proyectos.*',
            'peticions.descripcion',
            'peticions.id as peticionID'
            )
          //->select()
          ->where('proyectos.estado','Programado')
          ->where('proyectos.idperiodos',$idperiodo->id)
          ->paginate(8);
          //->get();
      /////peticion con periodo actual
      //  $proyecto=proyecto::where('estado','Programado')
        //->where('idperiodos',$idperiodo->id)->paginate(8);
      
      ////muestra los priodos para seleccionarlos 
        $periodos=periodo::latest()->get();  
        //return Response::json($periodo);
           return view('proyectos.showProyecto',[
            'proyectos'=> $proyecto,
            'estado'=>$estado,
            'periodos'=>$periodos,
            'periodoActual'=>$idperiodo->semestre,
            ]);
    }
    public function showEstado($estado){
      if($estado==1){
        $estado='Cancelado';  
        $periodos=periodo::latest()->get();   
        $idperiodo=periodo::where('estado','iniciado')->get()->first();
        $proyecto =DB::table('proyectos')
          ->join('peticions', 'proyectos.idpeticions', '=', 'peticions.id')
          ->select('proyectos.*',
            'peticions.descripcion',
            'peticions.id as peticionID'
            )
          ->where('proyectos.estado','Cancelado')
          ->where('proyectos.idperiodos',$idperiodo->id)
          ->paginate(8);
       /* $proyecto=proyecto::where('estado','Cancelado')
        ->where('idperiodos',$idperiodo->id)->paginate(8);
         */
           }else if($estado==2){
        $estado='Finalizado';
        $periodos=periodo::latest()->get();
         $idperiodo=periodo::where('estado','iniciado')->get()->first();  
           $proyecto =DB::table('proyectos')
          ->join('peticions', 'proyectos.idpeticions', '=', 'peticions.id')
          ->select('proyectos.*',
            'peticions.descripcion',
            'peticions.id as peticionID'
            )
          ->where('proyectos.estado','Finalizado')
          ->where('proyectos.idperiodos',$idperiodo->id)
          ->paginate(8);
            /*$proyecto=proyecto::where('estado','Finalizado')
            ->where('idperiodos',$idperiodo->id)->paginate(8);
         */
           }

           return view('proyectos.showProyecto',[
            'proyectos'=> $proyecto,
            'estado'=>$estado,
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

   public function createDonacion(createDonacionRequest $request){
        //dd($request->all());
       // return Response::json($request);
        
        $periodo=periodo::where('estado','Iniciado')->get()->first();
        $message2 = proyecto::find($request->input('proyecto_id'));

       
       $message= donacion::create([
            'monto'=> $request->input('monto'),
            'descripcion'=> $request->input('descripcion'),
            'fecha'=> $request->input('fecha'),
            'tipo'=> 'Realizada',
            'categoria'=>$request->input('categoria'),
            'idpeticions'=> $message2->idpeticions,
            'idperiodos'=>$periodo->id,
            ]);
             //return Response::json($message);
        $message2->fill([
            'estado'=>'Finalizado',
            ]);
        $message2->save();
        $message3 = peticion::find($message2->idpeticions);
        $message3->fill([
            'estado'=>'Finalizado',
            ]);
        $message3->save();
        
        return Response::json($message);
        //return redirect('/socios')->with('mensaje','Registro Guardado');

    }//fin cereateDonacion



    
}
