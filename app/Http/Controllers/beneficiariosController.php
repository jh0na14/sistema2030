<?php

namespace App\Http\Controllers;
use App\beneficiario;
use Illuminate\Http\Request;

class beneficiariosController extends Controller
{
    //
    public function show(){   
    	$beneficiarios=beneficiario::latest()->paginate(10);  
    	   return view('beneficiarios.show',[
    		'beneficiarios'=> $beneficiarios,
    		]);
    }
  
}
