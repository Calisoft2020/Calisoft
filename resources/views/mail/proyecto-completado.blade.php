@component('mail::message')
#Hola {{ $user->name }}

Su proyecto **{{ $proyecto->nombre }}**
cambió su estado a **completado**, ya puede ver los resultados en los diferentes informes.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
