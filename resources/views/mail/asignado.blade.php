@component('mail::message')
#Hola {{ $user->name }}

Se le ha asignado el proyecto: **{{ $proyecto->nombre }}**.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
