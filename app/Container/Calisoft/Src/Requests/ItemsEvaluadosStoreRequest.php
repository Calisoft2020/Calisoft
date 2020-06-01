<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsEvaluadosStoreRequest extends FormRequest
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
           'atributo' => 'required|string|max:40',
           'fila'     => 'required|integer',
           'calificacion' => 'required',
           'FK_scriptId'  => 'required|integer',
           'FK_itemId'  => 'required|integer',
        ];
    }
}
