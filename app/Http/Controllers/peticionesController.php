<?php

namespace App\Http\Controllers;
use App\solicitante;
use App\beneficiario;
use App\peticion;
use App\periodo;
use App\proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\createPeticionRequest;
use App\Http\Requests\createProyectosRequest;

class peticionesController extends Controller
{
    //
    public function show(){   
    	$estado='Disponible';
      ////id periodo actual
        $idperiodo=periodo::where('estado','iniciado')->get()->first();//->pluck('id')->get()->first();
      /////peticion con periodo actual
        $peticion=peticion::where('estado','Disponible')
        ->where('idperiodos',$idperiodo->id)->paginate(8);
      ////muestra los priodos para seleccionarlos 
        $periodos=periodo::latest()->get();  
        //return Response::json($periodo);
           return view('peticiones.showPeticion',[
            'peticiones'=> $peticion,
            'estado'=>$estado,
            'periodos'=>$periodos,
            'periodoActual'=>$idperiodo->semestre,
            ]);
    }
    public function showEstado($estado){
      if($estado==1){
        $estado='En Progreso';  
        $periodos=periodo::latest()->get();   
        $idperiodo=periodo::where('estado','iniciado')->get()->first();
        $peticion=peticion::where('estado','En Progreso')
        ->where('idperiodos',$idperiodo->id)->paginate(8);
         
           }else if($estado==2){
        $estado='Finalizado';
        $periodos=periodo::latest()->get();
         $idperiodo=periodo::where('estado','iniciado')->get()->first();  
            $peticion=peticion::where('estado','Finalizado')
            ->where('idperiodos',$idperiodo->id)->paginate(8);
         
           }else if($estado==3){
        $estado='Cancelado';
        $periodos=periodo::latest()->get();
         $idperiodo=periodo::where('estado','iniciado')->get()->first();  
            $peticion=peticion::where('estado','Cancelado')
            ->where('idperiodos',$idperiodo->id)->paginate(8);
         
           }

           return view('peticiones.showPeticion',[
            'peticiones'=> $peticion,
            'estado'=>$estado,
            'periodos'=>$periodos,
            'periodoActual'=>$idperiodo->semestre,
            ]);
    }

    public function showParametros($estado,$semestre){   
     if($estado=='Disponible'){
        //$estado='Disponible';   
        //erdiodo activo o iniciado no se o del pluck me da problema aca
        $idperiodo=periodo::where('semestre',$semestre)->get()->first();//->pluck('id')->get()->first();
        $peticion=peticion::where('estado','Disponible')
        ->where('idperiodos',$idperiodo->id)->paginate(8);  
        $periodos=periodo::latest()->get();  
       // $periodos=periodo::where('id',$idperiodo)->get(); 
       
     }elseif($estado=='EnProgreso'){//para que no aparezca en navegador Sin%20Finalizar
        $estado='En Progreso';   
        //erdiodo activo o iniciado
        $idperiodo=periodo::where('semestre',$semestre)->get()->first();
        $peticion=peticion::where('estado','En Progreso')
        ->where('idperiodos',$idperiodo->id)->paginate(8);
        $periodos=periodo::latest()->get();  
           
     }else if($estado=='Finalizado'){
        //$estado='Finalizado';
            //erdiodo activo o iniciado
            $idperiodo=periodo::where('semestre',$semestre)->get()->first();
            $peticion=peticion::where('estado','Finalizado')
            ->where('idperiodos',$idperiodo->id)->paginate(8);
            $periodos=periodo::latest()->get();  
         
      }else if($estado=='Cancelado'){
        //$estado='Finalizado';
            //erdiodo activo o iniciado
            $idperiodo=periodo::where('semestre',$semestre)->get()->first();
            $peticion=peticion::where('estado','Cancelado')
            ->where('idperiodos',$idperiodo->id)->paginate(8);
            $periodos=periodo::latest()->get();  
         
          }
    

           return view('peticiones.showPeticion',[
            'peticiones'=> $peticion,
            'estado'=>$estado,
            'periodos'=>$periodos,
            'periodoActual'=>$idperiodo->semestre,
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

    public function buscar1($id){
      $message = peticion::find($id);
    return Response::json($message);

    } 
    public function buscar($id){
    	// $message = DB::table('peticions')->get();

    	  $message =DB::table('peticions')
    	 ->join('solicitantes', 'peticions.idsolicitantes', '=', 'solicitantes.id')
          ->join('beneficiarios', 'peticions.idbeneficiarios', '=', 'beneficiarios.id')
          ->join('periodos', 'peticions.idperiodos', '=', 'periodos.id')
          ->select('peticions.*',
          	'solicitantes.nombre',
          	'solicitantes.apellido',
          	'solicitantes.dui',
          	'beneficiarios.nombre as nombreBen',
          	'beneficiarios.apellido as apellidoBen',
          	'beneficiarios.dui as duiBen',
          	'beneficiarios.descripcion as direccion',
            'periodos.semestre'
          	)
          //->select()
          ->where('peticions.id',$id)
          //->paginate(8)
          ->get();
          return Response::json($message);

    }
    
    public function darBaja(Request $request,$id){
      if($request->input('motivoCancelacion')==""){
       $array = array('validar' => 'el campo motivo es obligatorio', );
       return Response::json($array);
           }
    	$message = peticion::find($id);//all()->where('id',"=",$socio_id);
        $message->fill([
            'estado'=>'Cancelado',
            'motivoCancelacion'=> $request->input('motivoCancelacion'),
            ]);
        if($message->save())
            return Response::json('Paticion '.$message->titulo.' '.'No se programo');
            else
                return Response::json('No pudo cambiar peticion');

    }
    public function busqueda2($texto){
        $output="";
        $messages=peticion::where('titulo','like','%'.$texto.'%')
        ->limit(6)
        //->orWhere('descripcion','like','%'.$texto.'%')
        ->get();
        if($messages){
            foreach ($messages as $key => $message) {
                if($message->estado=='Disponible')
                {
                    $sAc='<div class="col-12">
   <div class="card  card-outline- " style="margin:5px; {{--max-height: 20rem;--}} {{--@if($peticion->id==8)display:none;@endif--}}">
  <div class="card-block">
    <h6 class="card-title">'.$message->titulo.'</h6>
    <hr>
    <p class="card-text" style="font-size:13px">'.$message->descripcion.'</p>
    <div class="card-text text-muted float-right" style="font-size:12px">'.$message->created_at.'</div>
  </div>  
<div class="card-footer" {{--style="background-color: #fBfBfB"--}}>  
    <button type="button"style="font-size:12px" class="btn btn-outline-primary btn-sm peticionModal" value="'.$message->id.'">Crear Proyecto</button>
    <button type="button" style="font-size:12px" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">+Info</button>
    <button type="button" style="font-size:12px" class="btn btn-outline-danger btn-sm editModal" value="'.$message->id.'">Eliminar</button>
      
</div> 
</div>
</div>';
                }else{
            $sAc='<div class="col-12">
   <div class="card  card-outline- " style="margin:5px; {{--max-height: 20rem;--}} {{--@if($peticion->id==8)display:none;@endif--}}">
  <div class="card-block">
    <h6 class="card-title">'.$message->titulo.'</h6>
    <hr>
    <p class="card-text" style="font-size:13px">'.$message->descripcion.'</p>
    <div class="card-text text-muted float-right" style="font-size:12px">'.$message->created_at.'</div>
  </div>  
<div class="card-footer" {{--style="background-color: #fBfBfB"--}}>  
    <button type="button" style="font-size:12px" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">+Info</button>
      
</div> 
</div>
</div>';    }
              
                $output.=$sAc;        
         }
            return Response::json($output);
        }
            return Response::json($messages);
        
    }//fin busqueda
     public function busqueda($texto){
        $output="";
        $messages=peticion::where('titulo','like','%'.$texto.'%')
        ->limit(6)
        //->orWhere('descripcion','like','%'.$texto.'%')
        ->get();
        if($messages){
            foreach ($messages as $key => $message) {
                if($message->estado=='Disponible')
                {
                    $sAc='<tr id="'.$message->id.'">
      <td style="font-size:14px">#'.$message->id.'</td> 
			<td>'.$message->titulo.'</td>
			<td >'.$message->descripcion.'</td>
			<td class="text-center">
        <button type="button" class="btn btn-outline-primary btn-sm peticionModal" value="'.$message->id.'">Crear Proyecto</button>
				<button type="button" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">Info</button>
				<button type="button" class="btn btn-outline-danger btn-sm darBaja" value="'.$message->id.'">Eliminar</button>
			</td>
        </tr>';
                }else{
            $sAc='<tr id="'.$message->id.'">
      <td style="font-size:14px">#'.$message->id.'</td> 
			<td>'.$message->titulo.'</td>
			<td >'.$message->descripcion.'</td>
			<td class="text-center">
        <button type="button" class="btn btn-outline-primary btn-sm peticionModal" value="'.$message->id.'">Crear Proyecto</button>
				<button type="button" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">Info</button>
			</td>
        </tr>';    }
               $output.=$sAc;        
        }
            return Response::json($output);
        }
            return Response::json($messages);
        
    }//fin busqueda funcion
}
