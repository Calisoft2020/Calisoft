<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CasoPruebaStoreRequest extends FormRequest
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
            'nombre' => 'required|string|max:50',
            'proposito'=> 'required|string|max:200',
            'alcance'=> 'required|string|max:200',
            'resultado_esperado'=> 'required|string|max:200',
            'criterios' => 'required|string|max:200',
            'prioridad'=> 'required|string|max:200',
            'limite' => 'required',
            'FK_ProyectoId'=> 'required|integer',
        ];
    }
}
