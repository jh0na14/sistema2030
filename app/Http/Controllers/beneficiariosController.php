<?php

namespace App\Http\Controllers;
use App\beneficiario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;

use App\Http\Requests\createBeneficiariosRequest;
//cmd php artisan make:controller beneficiariosController
class beneficiariosController extends Controller
{
    //
    public function show(){   
    	$beneficiarios=beneficiario::latest()->paginate(8);  
    	   return view('beneficiarios.showBen',[
    		'beneficiarios'=> $beneficiarios,
    		]);
    }
    
    public function buscar($id){
    $beneficiario = beneficiario::find($id);
    return Response::json($beneficiario);

    } 
    public function create(createBeneficiariosRequest $request){
    	//dd($request->all());
    	$message= beneficiario::create($request->all());
		//$response = socio::create($request->all());	
   		 
    	return Response::json($message);
    	
    	
    	return redirect('/socios')->with('mensaje','Registro Guardado');

    }
    public function update(createBeneficiariosRequest $request,$id){
    	//dd($request->all());
    	$message = beneficiario::find($id);
    	 $message->fill($request->all());
    	$message->save();
    	return Response::json($message);
    	//return response(json($array));
    }

    public function busqueda($texto){
    	$output="";
    	$messages=beneficiario::where('nombre','like','%'.$texto.'%')
    	->orWhere('apellido','like','%'.$texto.'%')
    	->orWhere('dui','like','%'.$texto.'%')
    	->get();
    	if($messages){
    		foreach ($messages as $key => $message) {
    			$output.='<tr>'.
    					'<td>'.$message->nombre.'</td>'.
    					'<td>'.$message->apellido.'</td>'.
    					'<td>'.$message->dui.'</td>'.
    					'<td>'.$message->fechaNac.'</td>'.
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
