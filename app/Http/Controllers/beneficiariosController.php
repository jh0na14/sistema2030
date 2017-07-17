<?php

namespace App\Http\Controllers;
use App\beneficiario;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;

use App\Http\Requests\createBeneficiariosRequest;
class beneficiariosController extends Controller
{
    //
    public function show(){   
    	$beneficiarios=beneficiario::latest()->paginate(10);  
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
    	$message = socio::find($id);
    	 $message->fill($request->all());
    	$message->save();
    	return Response::json($message);
    	//return response(json($array));
    }

 
 /*$table->increments('id');
            $table->string('nombre',30);
            $table->string('apellido', 30);
            $table->string('dui', 10);
            $table->date('fechaNac');
            $table->text('descripcion');            
            $table->timestamps();
		*/
}
