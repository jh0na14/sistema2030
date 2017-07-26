<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createVerdugoRequest extends FormRequest
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
                'fechaPago' => ['required','max:10'],
                'montoRecaudado' => ['required'],
                'montoRifa' => ['required'],

                  ];    
                //break;
               }
              case 'POST':
              {

             return [
                'fechaPago' => ['required','max:10'],
                'montoRecaudado' => ['required'],
                'montoRifa' => ['required'],
                    
                  ]; 
                  
                break;
              }
            
            default:
                # code...
                break;
        }//fin switch
    }
}
