@component('mail::message')
#Hola {{ $user->name }}

Se le ha asignado el caso prueba **{{ $caso }}**
a su proyecto: **{{ $proyecto }}**, en la página principal recibirá la información del procedimiento a seguir.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
