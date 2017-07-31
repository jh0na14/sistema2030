<?php

namespace App\Http\Controllers;
use App\patrocinador;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use App\Http\Requests\createPatrocinadorRequest;

//cmd php artisan make:controller beneficiariosController
class patrocinadorController extends Controller
{

    //
    public function show(){   
        $patrocinador=patrocinador::latest()->paginate(10);  
           return view('patrocinadores.showPatro',[
            'patrocinadores'=> $patrocinador,
            ]);
    }
    
    public function buscar($id){
    $patrocinador = patrocinador::find($id);
    return Response::json($patrocinador);

    } 
    public function create(createPatrocinadorRequest $request){
        //dd($request->all());
        $message= patrocinador::create($request->all());
        //$response = socio::create($request->all());   
         
        return Response::json($message);
        
        
        return redirect('/patrocinador')->with('mensaje','Registro Guardado');

    }
    public function update(createPatrocinadorRequest $request,$id){
        //dd($request->all());
        $message = patrocinador::find($id);
         $message->fill($request->all());
        $message->save();
        return Response::json($message);
        //return response(json($array));
    }
	
	public function busqueda($texto){
    	$output="";
    	$messages=patrocinador::where('nombre','like','%'.$texto.'%')
    	->get();
    	if($messages){
    		foreach ($messages as $key => $message) {
    			$output.='<tr>'.
    					'<td>'.$message->nombre.'</td>'.
    					'<td>'.$message->descripcion.'</td>'.
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

    //
}
