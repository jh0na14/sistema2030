<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
/// php artisan make:request createNombrelicitantes
class createSolicitantesRequest extends FormRequest
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
                'apellido' => ['required','max:30'],
                'dui' => 'required|max:10|unique:solicitantes,dui,'.$this->id,//.$this->socios,
                 //'dui'=>Rule::unique('socios')->ignore($socios->id);
                'telefono' => ['required'],
                  ];    
                //break;
               }
              case 'POST':
              {

             return [
                'nombre' => ['required','max:30'],
                'apellido' => ['required','max:30'],
                'dui' => 'required|max:10|unique:solicitantes,dui,',//.$this->socios,
                 //'dui'=>Rule::unique('socios')->ignore($socios->id);
                'telefono' => ['required'],
                  ]; 

                break;
              }
            
            default:
                # code...
                break;
        }//fin switch
    }
}
