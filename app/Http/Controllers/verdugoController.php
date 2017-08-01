<?php

namespace App\Http\Controllers;
use App\verdugo;
use App\socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\createVerdugoRequest;

class verdugoController extends Controller
{
    //
        //
    public function show(){   
    	$verdugo=DB::table('verdugos')
    	->join('socios','verdugos.idsocios','=','socios.id')
    	->select('verdugos.*','socios.nombre','socios.apellido')
    	->paginate(10);
    	//->get();
    	 //return Response::json($verdugo);
        //$verdugo=verdugo::latest()->paginate(10);  
       // return Response::json($verdugo);
           return view('verdugos.showVerdu',[
            'verdugos'=> $verdugo,
            ]);
    }
    
    public function buscar($id){
    $verdugo = verdugo::find($id);
    return Response::json($verdugo);

    } 
    public function create(createVerdugoRequest $request){
        //dd($request->all());
        $message= verdugo::create($request->all());
        //$response = socio::create($request->all());   
         
        return Response::json($message);
        
        
        return redirect('/verdugo')->with('mensaje','Registro Guardado');

    }
    public function update(createverdugoRequest $request,$id){
        //dd($request->all());
        $message = verdugo::find($id);
         $message->fill($request->all());
        $message->save();
        return Response::json($message);
        //return response(json($array));
    }
	
	public function busqueda($texto){
    	$output="";
    	$messages=verdugo::where('fechaPago','like','%'.$texto.'%')
    	->get();
    	if($messages){
    		foreach ($messages as $key => $message) {
    			$output.='<tr>'.
    					'<td>'.$message->fechaPago.'</td>'.
    					'<td>'.$message->montoRecaudado.'</td>'.
    					'<td>'.$message->montoRifa.'</td>'.
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
