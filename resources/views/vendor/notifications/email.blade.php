@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# Ups
@else
# Hola,
@endif
@endif

Haga clic en el botón de abajo para verificar su dirección de correo electrónico.

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{--{{ $actionText }}--}}
    Verificar email
@endcomponent
@endisset

{{-- Outro Lines --}}

Si no creó una cuenta, no se requiere ninguna otra acción.

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Gracias,<br>
SGAM
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Si tiene problemas para hacer clic en el botón \"Verificar Email\", copie y pegue la URL debajo de\n".
    'en su navegador web: [:actionURL](:actionURL)',
    [
        'actionText' => $actionText,
        'actionURL' => $actionUrl,
    ]
)
@endslot
@endisset
@endcomponent
