<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaUpdateRequest extends FormRequest
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
          'PK_id' => 'required|integer',
          'nombre' => sprintf('string|unique:TBL_Categorias,nombre,%d,PK_id', $this->PK_id),
          'plataforma' => 'integer',
          'modelado' => 'integer',
          'base_datos' =>'integer',
          'codificacion'=>'integer',
          'descripcion' => 'string|max:200',
          
        ];
    }
}
