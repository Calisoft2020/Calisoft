@component('mail::message')
#Hola {{ $user->name }}

El estudiante **{{ $estudiante }}** perteneciente al proyecto: **{{ $proyecto }}**, 
envió el formulario del caso prueba **{{ $caso }}**. Por favor proceda a realizar su evaluación.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
