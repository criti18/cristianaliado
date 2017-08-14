@component('mail::message')
# Hola {{$user->name}}

Te damos la bienvenida a Tu Aliado Seguro, hemos recibido tu solicitud de ingreso,  nuestra plataforma integra a los mejores asesores de seguros, por lo que por ello verificamos que los datos que se ingresen sean verídicos,  este proceso de validación tardará aproximadamente 24 horas.
<br>
Si pasado este tiempo no recibes respuesta, por favor contáctanos.
<br>
Recuerda que parte de los beneficios de formar parte de Tu Aliado Seguro, es la doble garantía que se les otorgará a tus clientes que compren a través de nuestra plataforma.

@component('mail::button', ['url' => 'https://tualiadoseguro.com/info/preguntas-frecuentes'])
Preguntas frecuentes
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent
