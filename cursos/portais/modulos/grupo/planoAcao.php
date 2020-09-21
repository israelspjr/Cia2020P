<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$PlanoAcao = new PlanoAcao();

//$idPlanoAcaoGrupo = $_REQUEST['id'];
$idPlanoAcao = $_REQUEST['id'];
?>
 <button class="gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/grupo/index.php', '#centro');" >Fechar </button>
<div>
	<?php
    $PlanoAcao->setIdPlanoAcao($idPlanoAcao); 
    echo $PlanoAcao->ImprimePlanoAcao("3");    
    ?>
</div>
 