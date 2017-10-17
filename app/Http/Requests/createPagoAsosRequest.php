<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createPagoAsosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       switch ($this->method()) {
              case 'PUT':
              case 'PATCH':
              { 
                //fechaPago, montoRecaudado, montoRifa,
             return [   
                'monto' => ['required','max:10'],       
                'fecha' => ['required','max:10'],
                'idPeriodos' => ['required'],
                
                  ];    
                //break;
               }
              case 'POST':
              {

             return [
                'monto' => ['required','max:10'],
                'fecha' => ['required','max:10'],
                'idPeriodos' => ['required'],
                    
                  ]; 
                  
                break;
              }
            
            default:
                # code...
                break;
        }//fin switch
    }
}
