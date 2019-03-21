@component('mail::message')

Olá. <br>
Bem vindo ao Rede Credenciados.
Por favor, acesse o link abaixo para confirmar seu cadastro na Rede Credenciados.

@component('mail::button', ['url' => $url])
Link de Confirmação
@endcomponent


Obrigado,<br>
Rede Credenciados
@endcomponent