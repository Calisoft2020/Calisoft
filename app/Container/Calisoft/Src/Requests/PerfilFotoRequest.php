<?php

namespace App\Container\Calisoft\Src\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class PerfilFotoRequest extends FormRequest
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
            'foto' => 'required|image|max:1000',
        ];
    }

    /**
    * Reemplaza la foto de perfil
    *
    * @return string url de la nueva foto de perfil
    */
    public function commit($old){
        $disk = Storage::disk('public');
        $oldPath = str_replace('/storage/', '', $old); //obtiene la ruta el archivo antiguo
        $disk->delete($oldPath); //elimina el archivo antiguo
        $path = $this->foto->store('fotos', 'public'); //guarda el archivo nuevo
        return $disk->url($path);
    }
}
