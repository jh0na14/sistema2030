<?php

namespace App\Http\Controllers;
use App\agenda;
use App\punto;
use App\subpunto;
use App\socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
//use App\Http\Requests\createVerdugoRequest;

class actaController extends Controller
{
    //
        //
    public function show($idagendas){   
    	/*$verdugo=DB::table('verdugos')
    	->join('socios','verdugos.idsocios','=','socios.id')
    	->select('verdugos.*','socios.nombre','socios.apellido')
    	->paginate(10);
    	*/
        //->get();
    	 //return Response::json($verdugo);
       // $agenda=agenda::latest()->paginate(10);
       $agenda=agenda::where('id',$idagendas)->get();
        foreach($agenda as $x)
       {
         $numAgenda=$x->numAgenda;
    
       }
        //return Response::json($numAgenda);
           return view('agendas.showActa',[
            'numAgenda'=> $numAgenda,
            'agendas'=> $agenda,
            ]);
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


    public function updatePuntos(Request $request,$id){
        if($request->input('nivel')==1){
        $message = punto::find($id);//all()->where('id',"=",$socio_id);
        $message->fill([
            'descripcion'=>$request->input('descripcion'),
            ]);
        $message2=agenda::find($request->input('idAgenda'));
        $message2->fill([
            'horaInicio'=>$request->input('horaInicio'),
            'horaFin'=>$request->input('horaFin'),
            ]);
        if($message->save() && $message2->save())
            return Response::json('Se actualizo el punto');
            else
                return Response::json('No pudo actualizar el punto');
    
        }
        if($request->input('nivel')==2){
        $message = subpunto::find($id);//all()->where('id',"=",$socio_id);
        $message->fill([
            'descripcion'=>$request->input('descripcion'),
            ]);
        if($message->save())
            return Response::json('Se actualizo el subpunto');
            else
                return Response::json('No pudo actualizar el subpunto');
    
        }
       

    }
    

	


}
