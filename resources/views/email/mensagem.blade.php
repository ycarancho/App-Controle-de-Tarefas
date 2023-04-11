@component('mail::message')
# Introdução

O corpo da Mensagem.

@component('mail::button', ['url' => ''])
Texto do Botão
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent
