@component('mail::message')

# Olá. <br>
Este e-mail é devido ao pedido de recuperação de senha. <br>

Por favor, acesse o link abaixo para confirmar a alteração de senha.

@component('mail::button', ['url' => $url])
Link 
@endcomponent

Se você não requisitou uma nova senha, favor desconsiderar esse e-mail.<br>

Obrigado,<br>
# Rede Credenciados
@endcomponent
