<?php

namespace App\Http\Requests;
//use App\socio;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class CreateSociosRequest extends FormRequest
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
        //$socios = socio::find($this->socio_id);//all()->where('id',"=",$socio_id);
        switch ($this->method()) {
              case 'PUT':
              case 'PATCH':
              { 
             return [
                'nombre' => ['required','max:30'],
                'apellido' => ['required','max:30'],
                'fechaNac'=> ['required'],
                //'dui' => 'required|max:10|unique:socios,dui,38',
                'dui' => 'required|max:10|unique:socios,dui,'.$this->socio_id,//.$this->socios,
                 //'dui'=>Rule::unique('socios')->ignore($socios->id);
                'direccion' => ['required'],
                'telefono' => 'required',
                'email' => 'required|email|unique:socios,email,'.$this->socio_id,
                'apodo' => 'required',
                  ];    
                //break;
               }
              case 'POST':
              {

             return [
                'nombre' => ['required','max:30'],
                'apellido' => ['required','max:30'],
                'fechaNac'=> ['required'],
                //'dui' => 'required|max:10|unique:socios,dui,38',
                'dui' => 'required|max:10|unique:socios,dui,',//.$this->socios,
                 //'dui'=>Rule::unique('socios')->ignore($socios->id);
                'direccion' => ['required'],
                'telefono' => 'required',
                'email' => 'required|email|unique:socios,email',
                'apodo' => 'required',
                  ]; 

                break;
              }
            
            default:
                # code...
                break;
        }
    }
    
}
