<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/BackgroudIdiomaProfessor.class.php");

$arrayRetorno = array();
$idBackgroudIdiomaProfessor = $_REQUEST['id'];	

$BackgroudIdiomaProfessor = new BackgroudIdiomaProfessor();		
$BackgroudIdiomaProfessor->setIdBackgroudIdiomaProfessor($idBackgroudIdiomaProfessor);

if($_POST['acao'] == 'deletar'){
	
	$BackgroudIdiomaProfessor->deleteBackgroudIdiomaProfessor();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	
	
	$BackgroudIdiomaProfessor->setIdiomaProfessorIdIdiomaProfessor($_POST['idiomaProfessor_idIdiomaProfessor']);
	$BackgroudIdiomaProfessor->setEscolaIdEscola($_POST['idEscola']);	
	$BackgroudIdiomaProfessor->setComentario1($_POST['comentario1']);
	$BackgroudIdiomaProfessor->setComentario2($_POST['comentario2']);
	$BackgroudIdiomaProfessor->setObs($_POST['obs']);
	
	if($idBackgroudIdiomaProfessor != "" && $idBackgroudIdiomaProfessor > 0 ){
		$BackgroudIdiomaProfessor->updateBackgroudIdiomaProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;			
	}else{
		$idBackgroudIdiomaProfessor = $BackgroudIdiomaProfessor->addBackgroudIdiomaProfessor();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);
	
?>
