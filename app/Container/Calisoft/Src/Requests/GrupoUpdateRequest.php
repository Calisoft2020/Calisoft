<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoUpdateRequest extends FormRequest
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
            'PK_id' => 'integer|required',
            'nombre' => sprintf('string|unique:TBL_GruposDeInvestigacion,nombre,%d,PK_id', $this->PK_id)
        ];
    }
}
