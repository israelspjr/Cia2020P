<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$Configuracoes = new Configuracoes();

$config = $Configuracoes->selectConfig(1);
Uteis::pr($Configuracoes->getNomeEmpresa());
Uteis::pr($config);
?>
<fieldset>
  <legend>Love Mondays</legend>
<div>
<p>Olá, Você já ouviu falar do LoveMondays?</p>

<p>O LoveMondays é um site muito bacana onde os colaboradores colocam suas opiniões e avaliações sobre como é trabalhar em suas empresas.<br />

E ele tem crescido muito, é super comum verificar o LoveMondays antes de aceitar um trabalho novo ou fazer negócios com uma empresa.<br />

E como uma das forças da Companhia é o relacionamento, pensamos em alimentar a nossa página lá no LoveMondays com as opiniões da equipe administrativa e dos professores.<br />

Por isso é muito importante a sua opinião.<br />
<?php Uteis::pr($config); ?>
É só acessar a nossa página (<a href="https://www.lovemondays.com.br/trabalhar-na-companhia-de-idiomas/avaliacoes" target="_blank">https://www.lovemondays.com.br/trabalhar-na-companhia-de-idiomas/avaliacoes</a>) e clicar em “Postar uma avaliação” que o site vai redirecionar para uma página de cadastro. Não se preocupe a avaliação é anônima.

</div>
</fieldset>


