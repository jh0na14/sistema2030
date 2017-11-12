<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\periodo;
use App\socio;
use App\verdugo;
use Illuminate\Support\Facades\Response;
use DateTime;
use PDF;
use Illuminate\Support\Facades\DB;
class PDFController extends Controller
{
    public function ejemploPDF(){

    	$verdugo=DB::table('verdugos')
    	->join('socios','verdugos.idsocios','=','socios.id')
    	->select('verdugos.*','socios.nombre','socios.apellido')->get();
    	//->paginate(10);
    	 //return Response::json($verdugo);

    	$pdf=PDF::loadVIew('pdf.ejemplo',[
            'verdugos'=> $verdugo,
            ]);
    	/*$pdf=PDF::loadView('verdugos.showVerdu',[
            'verdugos'=> $verdugo,
            ]);
    	*/
    	//return $pdf->download('ejemplo.pdf');
    	//return $pdf->stream('showVerdu.pdf');
    	return $pdf->stream('ejemplo.pdf');
    }
}
