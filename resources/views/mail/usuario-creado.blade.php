@component('mail::message')
#Hola {{ $user->name }}

Usted a sido registrado en la plataforma Calisoft
como **{{$user->role}}** , con correo **{{$user->email}}** y contraseña **{{$password}}** ,
por favor cambiar contraseña cuando inicie sesion

@component('mail::button', ['url' => route('login')])
Ingresar a Calisoft
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
