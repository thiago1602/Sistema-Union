@component('mail::message')
# {{$produto}}}

Data de cadastro {{$data_cadastro}}

@component('mail::button', ['url' => $url])
Clique aqui para ver o produto
@endcomponent

Att,<br>
{{ config('app.name') }}
@endcomponent
