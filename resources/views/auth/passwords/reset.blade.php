@extends('layouts.master')

@section('content')
<form  method="POST" action="{{ route('password.request') }}">
    
    {{ csrf_field() }}

    <input type="hidden" name="token" value="{{ $token }}">

    @component('components.email', [
        'name' => 'email',
        'attributes' => 'required autofocus autocomplete=off',
        'label' => 'Correo',
        'help' => 'Digita el correo'
    ])
    @endcomponent

    <div class="row">
        <div class="col-md-6">
            @component('components.password', [
                'name' => 'password',
                'attributes' => "required",
                'label' => 'Contraseña',
                'help' => 'Digita la contraseña'
            ])
            @endcomponent
        </div>
        <div class="col-md-6">
            @component('components.password', [
                'name' => 'password_confirmation',
                'attributes' => "required",
                'label' => 'Confirmar contraseña',
                'help' => 'Digita la contraseña'
            ])
            @endcomponent
        </div>
    </div>
    

    
    

    <div class="text-center">
        <button type="submit" class="btn btn-success">
            Cambiar Contraseña
        </button>
    </div>
</form>
@endsection
