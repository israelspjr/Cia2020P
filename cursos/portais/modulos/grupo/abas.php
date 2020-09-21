<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$idPlanoAcaoGrupo = $_GET['id'];
	
?>
    <button class="bBlue" onclick="zerarCentro();carregarModulo('modulos/grupo/planoAcao.php?id=<?php echo $idPlanoAcaoGrupo?>', '#centro');" >Plano de Ação </button>
    
     <button class="gray" onclick="zerarCentro();carregarModulo('/cursos/portais/modulos/grupo/index.php', '#centro');" >Fechar </button>
    
        <?php require_once 'grupo.php';?>
        <?php require_once 'integranteGrupo.php';?>
 