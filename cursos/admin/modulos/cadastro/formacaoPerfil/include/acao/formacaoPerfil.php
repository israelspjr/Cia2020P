<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$arrayRetorno = array();
$idFormacaoPerfil = $_REQUEST['id'];	

$FormacaoPerfil = new FormacaoPerfil();		
$FormacaoPerfil->setidFormacaoperfil($idFormacaoPerfil);

if($_POST['acao'] == 'deletar'){
	
	$FormacaoPerfil->deleteFormacaoperfil();
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
}else{	
	
	$FormacaoPerfil->setClientePfIdClientePf($_POST['clientePf_idClientePf']);
	$FormacaoPerfil->setProfessorIdProfessor($_POST['professor_idProfessor']);

	$FormacaoPerfil->setProfessorIdProfessor($_POST['professor_idProfessor']);
	$FormacaoPerfil->setFormacao($_POST['idCertificadoCurso']);
	$FormacaoPerfil->setCurso($_POST['idCertificadoCurso1']);
	$FormacaoPerfil->setInstituicao($_POST['idEscola']);
	$FormacaoPerfil->setObs($_POST['obs']);
	$FormacaoPerfil->setFinalizado($_POST['finalizado']);
	
	if($idFormacaoPerfil != "" && $idFormacaoPerfil > 0 ){
		$FormacaoPerfil->updateFormacaoperfil();
		$arrayRetorno['mensagem'] = MSG_CADATU;			
	}else{
		$idFormacaoPerfil = $FormacaoPerfil->addFormacaoperfil();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);
	
?>
