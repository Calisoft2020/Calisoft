@component('mail::message')
#Hola {{ $user->name }}

Su proyecto **{{ $proyecto }}**
fue eliminado por la siguiente razón: **{{ $text }}**.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
