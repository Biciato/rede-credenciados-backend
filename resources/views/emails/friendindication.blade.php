@component('mail::message')

Olá. 
# {{ $nome_indicado }}<br>

# {{ $nome }} 
está te indicando para usar o sistema Rede Credenciados.<br>

Veja a mensagem que ele(a) deixou:<br>

{{ $mensagem }}

Obrigado,<br>
Rede Credenciados
@endcomponent