<?php

namespace App\Http\Controllers;
use App\pagoasociasion;
use App\socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\createPagoAsosRequest;

class pagoAsocController extends Controller
{
    //
        //
    public function show(){   
    	$pagoasoc=pagoasociasion::latest()->paginate(10);
    //	->join('socios','pagoAsociacions.idsocios','=','socios.id')
    	//->select('pagoAsociacions.*','socios.nombre','socios.apellido')
    	
    	//->get();
    	 //return Response::json($verdugo);
        //$verdugo=verdugo::latest()->paginate(10);  
       // return Response::json($verdugo);
           return view('pagoAsociacion.showPagoAsoc',[
            'pagoasoc'=> $pagoasoc,
            ]);
           
    }
    
    public function buscar($id){
    $pagoasoc = pagoasoc::find($id);
    return Response::json($pagoasoc);

    } 
    public function create(createPagoAsocRequest $request){
        //dd($request->all());
        $message= pagoasoc::create($request->all());
        //$response = socio::create($request->all());   
         
        return Response::json($message);
        
        
        return redirect('/pagoasoc')->with('mensaje','Registro Guardado');

    }
    public function update(createPagoAsocRequest $request,$id){
        //dd($request->all());
        $message = pagoasoc::find($id);
         $message->fill($request->all());
        $message->save();
        return Response::json($message);
        //return response(json($array));
    }
	
	public function busqueda($texto){
    	$output="";
    	$messages=pagoasoc::where('monto','like','%'.$texto.'%')
    	->get();
    	if($messages){
    		foreach ($messages as $key => $message) {
    			$output.='<tr>'.
    					'<td>'.$message->monto.'</td>'.
    					'<td>'.$message->fecha.'</td>'.
    					'<td>'.$message->idPeriodo.'</td>'.
    '<td class="text-center">'.
    '<button type="button" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">'.
    'Info</button> '.
    '<button type="button" class="btn btn-outline-success btn-sm editModal" value="'.$message->id.'">Editar</button> </td>'.
    '</tr>';
    		}
    		return Response::json($output);
    	}
    		return Response::json($messages);
    	
    }

  public function busquedaSelect(){
        $socio=socio::get(); 
    $array=array();
    $con=0;
    foreach($socio as $socios)
    {
        $array[$con]=([
        'id'=>$socios->id,
        'nombre'=>$socios->nombre,
        'apellido'=>$socios->apellido,
        ]);  
        $con++;
    }
        return Response::json($socio);  
    }


}
