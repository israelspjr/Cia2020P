<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$PlanoAcao = new PlanoAcao();

$idPlanoAcao = $_REQUEST['idPlanoAcao'];
?>

<!--<div id="dadosDemonstrativo"  class="conteudo_nivel">
  <div id="fechar_nivel" class="fechar" onclick="fecharNivel();" title="Fechar"></div>
	<br />--><?php
    $PlanoAcao->setIdPlanoAcao($idPlanoAcao); 
    echo $PlanoAcao->ImprimePlanoAcao("2");    
    ?>
</div>
<button class="button gray" onclick="zerarCentro();carregarModulo('modulos/ff/index.php', '#centro')">Fechar</button>
 