<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

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
	
	$FormacaoPerfil->setFormacao($_POST['formacao']);
	$FormacaoPerfil->setCurso($_POST['curso']);
	$FormacaoPerfil->setInstituicao($_POST['instituicao']);
	$FormacaoPerfil->setObs($_POST['obs']);
	
	if($idFormacaoPerfil != "" && $idFormacaoPerfil > 0 ){
		$FormacaoPerfil->updateFormacaoperfil();
		$arrayRetorno['mensagem'] = "Cadastro atualizado com sucesso";			
	}else{
		$idFormacaoPerfil = $FormacaoPerfil->addFormacaoperfil();		
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	
//	$arrayRetorno['fecharNivel'] = true;
}
echo json_encode($arrayRetorno);
	
?>
