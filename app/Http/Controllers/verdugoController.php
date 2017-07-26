<?php

namespace App\Http\Controllers;
use App\verdugo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Requests\createVerdugoRequest;

class verdugoController extends Controller
{
    //
        //
    public function show(){   
        $verdugo=verdugo::latest()->paginate(10);  
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

}
