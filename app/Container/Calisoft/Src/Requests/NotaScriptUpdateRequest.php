<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaScriptUpdateRequest extends FormRequest
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
            'PK_id'=>'required|integer',
            'nota'=>'numeric|required|',
            'total'=>'integer|required|min:0',
            'acertadas'=>'integer|required|min:0',
        ];
    }
}
