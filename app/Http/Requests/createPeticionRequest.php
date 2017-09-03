<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createPeticionRequest extends FormRequest
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
              case 'POST':
              {
             return [
                'titulo' => ['required','max:30'],
                'descripcion' => ['required','max:100'],
                'bene_id' => 'required',//.$this->socios,
                  ]; 

                break;
              }case 'PUT':
              {
             return [
                'titulo' => ['required','max:30'],
                'descripcion' => ['required','max:100'],
                 ]; 

                break;
              }
            
            default:
                # code...
                break;
        }//fin switch
    }
}
