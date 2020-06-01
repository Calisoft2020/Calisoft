@component('mail::message')
#Hola {{ $user->name }}

El usuario **{{ $from }}**
ha rechazado la invitación al proyecto **{{ $proyecto->nombre }}**.


Gracias,<br>
{{ config('app.name') }}
@endcomponent
