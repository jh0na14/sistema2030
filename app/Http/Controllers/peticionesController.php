<?php

namespace App\Http\Controllers;
use App\solicitante;
use App\beneficiario;
use App\peticion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;

//use App\Http\Requests\createSolicitantesRequest;

class peticionesController extends Controller
{
    //
    public function show(){   
    	$estado='Disponible';
        $peticion=peticion::where('estado','Disponible')->paginate(8);  
           return view('peticiones.showPeticion2',[
            'peticiones'=> $peticion,
            'estado'=>$estado,
            ]);
    }
    public function buscar($id){
    	// $message = DB::table('peticions')->get();

    	  $message =DB::table('peticions')
    	 ->join('solicitantes', 'peticions.idsolicitantes', '=', 'solicitantes.id')
          ->join('beneficiarios', 'peticions.idbeneficiarios', '=', 'beneficiarios.id')
          ->select('peticions.*',
          	'solicitantes.nombre',
          	'solicitantes.apellido',
          	'solicitantes.dui',
          	'beneficiarios.nombre as nombreBen',
          	'beneficiarios.apellido as apellidoBen',
          	'beneficiarios.dui as duiBen',
          	'beneficiarios.descripcion as direccion'
          	)
          //->select()
          ->where('peticions.id',$id)
          //->paginate(8)
          ->get();
          return Response::json($message);

    }
    public function showEstado($estado){
    	if($estado==1){
    		$estado='Sin Finalizar';   
    		$peticion=peticion::where('estado','Sin Finalizar')->paginate(8);  
           }else if($estado==2){
    		$estado='Finalizado';
           	$peticion=peticion::where('estado','Finalizado')->paginate(8);  
           }

           return view('peticiones.showPeticion',[
            'peticiones'=> $peticion,
            'estado'=>$estado,
            ]);
    }
    public function darBaja($id){
    	$message = peticion::find($id);//all()->where('id',"=",$socio_id);
        $message->fill([
            'estado'=>'Sin Finalizar',
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
