<?php

namespace App\Http\Controllers;
use App\sociomembresia;
use App\membresia;
use App\socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use DateTime;
//use Illuminate\Foundation\Http\FormRequest;



class pagosController extends Controller
{
    //
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

    public function show($socio_id){  
      $message = socio::find($socio_id);
       $numeroAnho=membresia::get(['año'])->last();  
       //return Response::json($numeroAnho->año);
       $pagos=DB::table('sociomembresias')
         ->join('membresias', 'sociomembresias.idmembresias', '=', 'membresias.id')
          ->select('sociomembresias.*',
            'membresias.monto',
            'membresias.año',
            'membresias.mes'
            )
          //->select()
          ->where('sociomembresias.idsocios',$socio_id)
          ->where('membresias.año' ,$numeroAnho->año)
          //->paginate(8)
          ->get();
          //return Response::json($pagos);
        $anhos=membresia::distinct()->latest()->get(['año']);  
        $deuda=PagosController::verDeuda($socio_id);
    	$estado='Disponible';
     /* ////id periodo actual
        $idperiodo=periodo::where('estado','iniciado')->get()->first();//->pluck('id')->get()->first();
      /////peticion con periodo actual
        $peticion=peticion::where('estado','Disponible')
        ->where('idperiodos',$idperiodo->id)->paginate(8);
      ////muestra los priodos para seleccionarlos 
        $periodos=periodo::latest()->get();  */
        //return Response::json($periodo);
           return view('pagos.showPagos',[
            'nombreSocio'=>$message->nombre,
            'idsocio'=>$socio_id,
            'pagos'=> $pagos,
            'anhos'=>$anhos,
            'deuda'=>$deuda,
            ]);
    }
    public function showParametros($socio_id,$anho){ 
       $message = socio::find($socio_id);
     
         $pagos=DB::table('sociomembresias')
         ->join('membresias', 'sociomembresias.idmembresias', '=', 'membresias.id')
          ->select('sociomembresias.*',
            'membresias.monto',
            'membresias.año',
            'membresias.mes'
            )
          //->select()
          ->where('sociomembresias.idsocios',$socio_id)
          ->where('membresias.año' ,$anho)
          //->paginate(8)
          ->get();
          //return Response::json($pagos);
        $anhos=membresia::distinct()->latest()->get(['año']);  
        $deuda=PagosController::verDeuda($socio_id);
           return view('pagos.showPagos',[
            'nombreSocio'=>$message->nombre,
            'idsocio'=>$socio_id,
            'pagos'=> $pagos,
            'anhos'=>$anhos,
            'deuda'=>$deuda,
            ]);  
     
         }

    public function createProyecto(createProyectosRequest $request){
        //dd($request->all());
       // return Response::json($request);
        
        $periodo=periodo::where('estado','Iniciado')->get()->first();
       $message= proyecto::create([
            'nombre'=> $request->input('nombre'),
            'fechaInicio'=> $request->input('fechaInicio'),
            'fechaFin'=> $request->input('fechaFin'),
            'tipo'=> 'Donacion',
            'estado'=>'Programado',
            'presupuesto'=> $request->input('presupuesto'),
            //'idrecaudacions'=> null,
            'idpeticions'=> $request->input('peticion_id'),
             
            'idperiodos'=>$periodo->id,
            ]);
        $message2 = peticion::find($request->input('peticion_id'));
        $message2->fill([
            'estado'=>'En Progreso',
            ]);
        $message2->save();
        return Response::json($message);
        
        
        return redirect('/socios')->with('mensaje','Registro Guardado');

    }
    public function update(createPeticionRequest $request,$id){
      $message = peticion::find($id);//all()->where('id',"=",$socio_id);
       $message->fill([
            'titulo'=>$request->input('titulo'),
            'descripcion'=>$request->input('descripcion'),
            ]);
        if($message->save())
            return Response::json(''.$message->titulo.'');
            else
                return Response::json('No pudo cambiar peticion');

      //return response(json($array));
    }       
  
  
  
    
   
}
