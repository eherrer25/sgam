@component('mail::message')

Porfavor has click en el boton de abajo para verificar tu email.

@component('mail::button', ['url' => $verifyUrl, 'color' => 'primary'])
Verificar Email
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
