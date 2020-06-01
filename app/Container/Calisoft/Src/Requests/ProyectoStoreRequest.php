<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoStoreRequest extends FormRequest
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
        return [
          'nombre'    => 'required|string|between:5,30|unique:TBL_Proyectos',
          'grupo'     => 'required|integer',
          'semillero' => 'required|integer',
          'categoria' => 'required|integer'
        ];
    }
}
