<?php

namespace App\Http\Controllers;
use App\socio;
use Illuminate\Http\Request;

class sociosController extends Controller
{
    public function show(){
    	 //->where('name', 'John')->value('email');
    	//$socios=DB::table('socios')->where('tipoSocio','=',"Socio Activo");//>paginate(10);
    	$tipoSocio="Socio Activo";
    	$socios=socio::all()->where('tipoSocio','=',"Socio Activo");//>paginate(10);

    	$count0=count($socios);
    	$count=socio::where('tipoSocio','=','Activo Mayor')->count();//count($socios);
    	   
    	 // dd($socios);
    	  
    	   return view('ejemplo',[
    		'socios'=> $socios,
    		'tipoSocio'=>$tipoSocio,
    		'count0'=>$count0,
    		'count'=>$count,
    		
    		]);
    }
    public function showactivoMayor($tipoSocio){
    	if($tipoSocio==1){///ES aactivo
    		$tipoSocio="Socio Activo";
    		$socios=socio::all()->where('tipoSocio','=',"Socio Activo");//>paginate(10);
    	    $count0=count($socios);
    	    $count=socio::where('tipoSocio','=','Activo Mayor')->count();//count($socios);
    	//count($socios);
    	    //dd($socios);  
    	}
    	if($tipoSocio==2){///ES aactivo Mayor
    		$socios=socio::all()->where('tipoSocio','=',"Activo Mayor");//>paginate(10);
    	    
    		$count=count($socios);
    	    $tipoSocio="Activo Mayor";
    	    $count0=socio::where('tipoSocio','=','Socio Activo')->count();//count($socios);
    	 //  dd($socios);
    	    //dd($count);  
    	}
    	return view('ejemplo',[
    		'socios'=> $socios,
    		'tipoSocio'=>$tipoSocio,
    		'count0'=>$count0,
    		'count'=>$count,
    		
    		]);
    	
    }
}
