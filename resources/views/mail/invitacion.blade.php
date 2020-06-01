@component('mail::message')
#Hola {{ $user->name }}

Haz recibido una invitacion por parte de **{{ $from->name }}**
para ser parte del proyecto **{{ $proyecto->nombre }}**.

@component('mail::button', ['url' => route('invitaciones')])
Ver invitacion
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
