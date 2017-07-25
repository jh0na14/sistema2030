<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createPatrocinadorRequest extends FormRequest
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
             return [             
                'nombre' => ['required','max:30'],
                'descripcion' => ['required'],
                  ];    
                //break;
               }
              case 'POST':
              {

             return [
                'nombre' => ['required','max:30'],
                'descripcion' => ['required'],
                  ]; 

                break;
              }
            
            default:
                # code...
                break;
        }//fin switch
    }
}
