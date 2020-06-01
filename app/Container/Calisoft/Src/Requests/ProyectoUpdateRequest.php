<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoUpdateRequest extends FormRequest
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
          'nombre'                    => sprintf('string|between:5,30|unique:TBL_Proyectos,nombre,%d,PK_id', $this->PK_id),
          'FK_CategoriaId'            => 'integer',
          'FK_SemilleroId'            => 'integer',
          'FK_GrupoDeInvestigacionId' => 'integer',
        ];
    }
}
