<?php

namespace App\Http\Controllers;
use App\agenda;
use App\punto;
use App\subpunto;
use App\socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\createVerdugoRequest;

class agendaController extends Controller
{
    //
        //
    public function show(){   
    	/*$verdugo=DB::table('verdugos')
    	->join('socios','verdugos.idsocios','=','socios.id')
    	->select('verdugos.*','socios.nombre','socios.apellido')
    	->paginate(10);
    	*/
        //->get();
    	 //return Response::json($verdugo);
        $agenda=agenda::latest()->paginate(10);  
       // return Response::json($verdugo);
           return view('agendas.showAgenda',[
            'agendas'=> $agenda,
            ]);
    }
    
    public function buscar($id){
    $message = agenda::find($id);
    return Response::json($message);

    } 
    public function create(Request $request){
        //dd($request->all());
       //s return Response::json("Endtro");
         $message = agenda::create([
            'numAgenda'=> $request->input('numAgenda'),
            'fecha'=> $request->input('fecha'),
            //'horaInicio'=>null,
            //'horaFin'=>null,
            ]);  
        return Response::json($message);
          
    }
    public function update(createverdugoRequest $request,$id){
        //dd($request->all());
        $message = verdugo::find($id);
         $message->fill($request->all());
        $message->save();
        return Response::json($message);
        //return response(json($array));
    }
   
    public function updatePuntos(Request $request,$id){
        if($request->input('nivel')==1){
        $message = punto::find($id);//all()->where('id',"=",$socio_id);
        $message->fill([
            'nombre'=>$request->input('nombre'),
            ]);
        if($message->save())
            return Response::json('Se actualizo el punto');
            else
                return Response::json('No pudo actualizar el punto');
    
        }
        if($request->input('nivel')==2){
        $message = subpunto::find($id);//all()->where('id',"=",$socio_id);
        $message->fill([
            'nombre'=>$request->input('nombre'),
            ]);
        if($message->save())
            return Response::json('Se actualizo el subpunto');
            else
                return Response::json('No pudo actualizar el subpunto');
    
        }
       

    }
     public function deletePuntos(Request $request,$id){
        if($request->input('nivel')==1){
        $message = punto::find($id);//all()->where('id',"=",$socio_id);
        if($message->delete())
            return Response::json('Se borro el punto');
            else
                return Response::json('No pudo borrar el punto');
    
        }
        if($request->input('nivel')==2){
        $message = subpunto::find($id);//all()->where('id',"=",$socio_id);
        if($message->delete())
            return Response::json('Se borro el subpunto');
            else
                return Response::json('No pudo borrar el subpunto');
    
        }
       

    }
    public function createPunto(Request $request){
       // return Response::json("Endtro");
         $message = punto::create([
            'nombre'=> $request->input('nombre'),
            'nivel'=> $request->input('nivel'),
            'idagendas'=>$request->input('idagendas'),
            'nivel'=>$request->input('nivel'),
            ]);  
        return Response::json($message);
          
    }
    public function createSubPunto(Request $request){
        // return Response::json("Endtro");
         $message = subpunto::create([
            'nombre'=> $request->input('nombre'),
            'nivel'=> $request->input('nivel'),
            'idpuntos'=>$request->input('idpuntos'),
            'nivel'=>$request->input('nivel'),
            ]);  
        return Response::json($message);
          
    }
     public function  tablaPuntos($idagendas){
         $messagex =DB::table('puntos')
         //->join('puntos', 'subpuntos.idpuntos', '=', 'puntos.id')
          ->select('puntos.*'
           // 'subpuntos.nombre as nombre2',
            //'subpuntos.nivel as nivel2',
            //'subpuntos.id as id2'
            )
          //->select()
          ->where('puntos.idagendas',$idagendas)
          //->paginate(8)
          ->get();
          $message=punto::where('idagendas',$idagendas)->get();
          $array = array();
          $i=0;
          $j=0;
    foreach($message as $x)
    {
        $j=0;
        $array[$i][$j]=[
        'id'=>$x->id,
        'nombre'=>$x->nombre,
        'descripcion'=>$x->descripcion,
        'nivel'=>$x->nivel
        ]; 
        $message2 =subpunto::where('idpuntos',$x->id)->get();
          $j=1;
        foreach ($message2 as $y) {
            $array[$i][$j]=[
        'id'=>$y->id,
        'nombre'=>$y->nombre,
        'descripcion'=>$y->descripcion,
        'nivel'=>$y->nivel
        ]; 
        $j++;
        }
       $i++;

    }
          return Response::json($array);
    }

    /*public function  xtablaPuntos($idagendas){
         $message =DB::table('puntos')
         //->join('puntos', 'subpuntos.idpuntos', '=', 'puntos.id')
          ->select('puntos.*'
           // 'subpuntos.nombre as nombre2',
            //'subpuntos.nivel as nivel2',
            //'subpuntos.id as id2'
            )
          //->select()
          ->where('puntos.idagendas',$idagendas)
          //->paginate(8)
          ->get();
          return Response::json($message);
    }
    public function  tablaSubPuntos($idpuntos){
         $message =DB::table('subpuntos')
         //->join('puntos', 'subpuntos.idpuntos', '=', 'puntos.id')
          ->select('subpuntos.*'
           // 'subpuntos.nombre as nombre2',
            //'subpuntos.nivel as nivel2',
            //'subpuntos.id as id2'
            )
          //->select()
          ->where('subpuntos.idpuntos',$idpuntos)
          //->paginate(8)
          ->get();
          return Response::json($message);
    }*/
	
	


}
