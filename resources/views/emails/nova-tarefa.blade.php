@component('mail::message')
# {{ $tarefa }}

Data limite de conclusão : {{$data_limite_conclusao}}

@component('mail::button', ['url' => $url])
Acesse a tarefa aqui !
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent
