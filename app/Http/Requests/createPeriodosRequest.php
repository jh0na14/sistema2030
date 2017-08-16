<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createPeriodosRequest extends FormRequest
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
                'fechaInicio' => 'required|date|date_format:Y-m-d|before:fechaFin',
                'fechaFin' => 'required|date|date_format:Y-m-d|after:fechaInicio',
                'semestre' => 'required',
                  ];    
                //break;
               }
              case 'POST':
              {

             return [
                'fechaInicio' => 'required|date|date_format:Y-m-d|before:fechaFin',
                'fechaFin' => 'required|date|date_format:Y-m-d|after:fechaInicio',
                'semestre' => 'required',
                  ]; 

                break;
              }
            
            default:
                # code...
                break;
        }//fin switch
    }
}
