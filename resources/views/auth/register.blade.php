@extends('layouts.master')

@section('content')
<form role="form" method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <div class="form-body">
        <div class="row">
            <div class="col-xs-6">
                <!-- Email Form Group -->
                @component('components.email', [
                    'name' => 'email',
                    'attributes' => "required",
                    'label' => 'Email',
                    'help' => 'Digita el correo',
                ])
                    
                @endcomponent
                <!-- End Email Form -->
            </div>
            <div class="col-xs-6">
                @component('components.text', [
                    'name' => 'name',
                    'attributes' => "required pattern='[a-zA-ZáéíóúñÁÉÍÓÚ ]{2,50}'",
                    'label' => 'Nombre',
                    'help' => 'Digita el nombre',
                    'icon' => 'fa fa-user'
                ])
                @endcomponent
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                @component('components.password', [
                    'name' => 'password',
                    'attributes' => "required pattern='[^=<> -]{5,30}'",
                    'label' => 'Contraseña',
                    'help' => 'Digita la contraseña'
                ])
                @endcomponent
            </div>
            <div class="col-xs-6">
                @component('components.password', [
                    'name' => 'password_confirmation',
                    'attributes' => "required pattern='[^=<> -]{5,30}'",
                    'label' => 'Confirmar Contraseña',
                    'help' => 'Confirmar la contraseña'
                ])
                @endcomponent
            </div>
        </div>

        <div class="row">
            <div class="text-center">
                <input class="btn green" type="submit" value="Registrarse">
            </div>
        </div>

    </div>
</form>
        

@endsection
