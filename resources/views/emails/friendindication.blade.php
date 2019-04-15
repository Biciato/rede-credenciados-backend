@component('mail::message')
<div style="border-left: 7px solid orange">   
    <p style="margin: 0.5rem">
        Mensagem do Indicador(a):<br>
        {{ $mensagem }}
    </p>
</div>

Olá <font size="4"><strong>{{ $nome_indicado }}</strong></font>,<br>

você foi indicado(a) por <font size="4"><strong>{{ $nome }}</strong></font> para que conheça o <strong>Portal Rede Credenciados</strong>. 

O <strong>Portal Rede Credenciados</strong> é exclusivo para pessoas e empresas que trabalham na área de Medicina 
e Segurança do Trabalho, e o melhor totalmente <strong>GRATUITO</strong>. 

--Divulgue seus serviços para quem realmente precisa;<br>
--Receba pedidos de cotação de quem procura seus serviços;<br>
--Inclua fotos de sua empresa para que conheçam sua estrutura;<br>
--Inclua sua apresentação institucional; <br>

Tudo isso e muito mais, e o que é melhor totalmente Gratuito .<br>

<a href="https://rede-credenciados.firebaseapp.com/home" style="text-decoration: none;">Clique Aqui</a>
<font color="#74787e" style="font-weight: 400">e conheça o <strong>Portal Rede Credenciados</strong></font><br>
<font size="1">Esta é uma mensagem gerada automaticamente, portanto, não deve ser respondida.</font>
-----------------------------------------------------------------------------------------------

@endcomponent