@component('mail::message')

# Olá. <br>
Você tem uma mensagem vinda do Rede Credenciados.


**Nome:** {{ $nome }} <br>
**Email:** {{ $email }} <br>
**Telefone:** {{ $tel }} <br>
**Celular:** {{ $cel }} <br>
**Mensagem:** <br>
{{ $mensagem }}

Obrigado, <br>
# Rede Credenciados
@endcomponent
