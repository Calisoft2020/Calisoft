<?php

namespace App\Container\Calisoft\Src\Controllers;

use App\Container\Calisoft\Src\Requests\PerfilFotoRequest;
use App\Container\Calisoft\Src\Requests\PerfilPasswordRequest;
use App\Container\Calisoft\Src\Requests\PerfilUpdateRequest;
use App\Container\Calisoft\Src\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('calisoft.global.perfil');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(PerfilPasswordRequest $request)
    {
        $user = auth()->user();

        if (Hash::check($request->pass_actual, $user->password)) {
            $user->password = bcrypt($request->pass_new);
            $user->save();
            $request->session()->flash('mensaje', __('perfil.contraseña_exito'));
        } else {
            $request->session()->flash('error', __('perfil.contraseña_error'));
        }
        return back();
    }

    public function update(PerfilUpdateRequest $request)
    {
        $user = $request->user();
        $user->fill($request->all());
        $user->save();
        $request->session()->flash('mensaje', __('perfil.actualizado'));
        return back();

    }

    public function fotoUp(PerfilFotoRequest $request)
    {
        $user = $request->user();
        $user->foto = $request->commit($user->foto); //actualiza el archivo
        $user->save();
        $request->session()->flash('mensaje', __('perfil.foto_exito'));
        return back();
    }

}
