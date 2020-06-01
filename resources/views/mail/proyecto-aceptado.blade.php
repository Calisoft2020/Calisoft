@component('mail::message')
#Hola {{ $user->name }}

Su proyecto **{{ $proyecto->nombre }}**
fue aceptado, ya puede subir la documentación correspondiente.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
