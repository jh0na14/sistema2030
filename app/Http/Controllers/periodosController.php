<?php

namespace App\Http\Controllers;
use App\periodo;
use App\socio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\createPeriodosRequest;

class periodosController extends Controller
{
    //
    public function show(){   
    	$periodo=periodo::latest()->paginate(8);  
    	   return view('periodos.showPeriodo',[
    		'periodos'=> $periodo,
    		]);
    }

    public function buscar($id){
    $periodo = periodo::find($id);
    return Response::json($periodo);
    } 

    public function create(createPeriodosRequest $request){
    	//dd($request->all());
    	//$select=periodo::where('estado','Iniciado')->first();
        if(periodo::where('estado','Iniciado')->first()){
            $select=periodo::where('estado','Iniciado')->first();
    	$select->fill([
    		'estado'=>'Finalizado',
    		])->save();
        }

    	$message= periodo::create($request->all());   		 
    	return Response::json($message);
    	
    	
    	return redirect('/socios')->with('mensaje','Registro Guardado');
    }

    public function update(createPeriodosRequest $request,$id){
    	//dd($request->all());
    	$message = periodo::find($id);
    	 $message->fill($request->all());
    	$message->save();
    	return Response::json($message);
    	//return response(json($array));
    }
    public function busqueda($texto){
    $output="";
        $messages=periodo::where('estado','like','%'.$texto.'%')
        //->orWhere('fechaFin','like','%'.$texto.'%')
        //->orWhere('estado','like','%'.$texto.'%')
        ->limit(6)
        ->get();
        if($messages){
            foreach ($messages as $key => $message) {
             $output.='<tr id="trow'.$message->id.'">
                     <td>'.$message->id.'</td>
                     <td>'.$message->fechaInicio.'</td>
                     <td >'.$message->fechaFin.'</td>
                     <td >'.$message->estado.'</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-outline-info btn-sm infomodal" value="'.$message->id.'">Info</button>
                        <button type="button" class="btn btn-outline-success btn-sm editModal" value="'.$message->id.'">Editar</button>
                        <button type="button" class="btn btn-outline-danger btn-sm" value="'.$message->id.'">Eliminar</button>
                    </td>
                </tr>';
            }
            return Response::json($output);
        }  

    } 

    public function busquedaSelect(){
    $message=socio::get(); 
   
        return Response::json($message);  

    } 

}
