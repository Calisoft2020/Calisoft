<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalificacionBdRequest extends FormRequest
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
            'total' => 'integer',
            'valor' => 'integer',
            'FK_TipoNomenclaturaId' => 'integer', 
            'FK_ArchivoBdId' => 'integer',    
        ];
    }
}
