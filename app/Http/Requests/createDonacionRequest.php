<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createDonacionRequest extends FormRequest
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
                'monto' => 'required',
                'descripcion' => 'required|max:50',
                'fecha' => 'required|date|date_format:Y-m-d',
                  ];    
                //break;
               }
              case 'POST':
              {

             return [
               'monto' => 'required',
                'descripcion' => 'required|max:50',
                'fecha' => 'required|date|date_format:Y-m-d',
                  ]; 

                break;
              }
            
            default:
                # code...
                break;
        }//fin switch
    }
}
