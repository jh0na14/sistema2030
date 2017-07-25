<?php

namespace App\Http\Controllers;
use App\patrocinador;
use Illuminate\Http\Request;
use App\Http\Requests\createPatrocinadorRequest;

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

    //
}
