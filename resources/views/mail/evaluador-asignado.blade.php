@component('mail::message')
#Hola {{ $user->name }}

Se le ha asignado el evaluador: **{{ $from->name }}**.
El correo del evaluador es: **{{ $from->email }}** por si necesita comunicarse con él.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
