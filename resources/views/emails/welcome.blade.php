@component('mail::message')
# Hola {{$user->name}}

Graciar por registrarte.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
