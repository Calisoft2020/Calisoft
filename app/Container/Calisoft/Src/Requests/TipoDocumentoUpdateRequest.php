<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoDocumentoUpdateRequest extends FormRequest
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
            'nombre' => 'string|max:50|unique:TBL_TiposDocumento,nombre,' . $this->PK_id . ',PK_id',
            'required' => 'sometimes|nullable|boolean'
        ];
    }
}
