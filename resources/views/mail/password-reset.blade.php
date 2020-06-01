@component('mail::message')
#Hola!

Has recibido este correo por que recibimos una petición de recuperacion
de contraseña desde tu cuenta.

@component('mail::button', ['url' => route('password.reset', compact('token')) ])
    Recuperar Contraseña
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent