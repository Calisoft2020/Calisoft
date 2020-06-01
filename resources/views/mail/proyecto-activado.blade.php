@component('mail::message')
#Hola {{ $user->name }}

Su proyecto **{{ $proyecto->nombre }}**
cambió su estado a **activado**, por favor proceda a realizar los cambios necesarios para su posterior envío.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
