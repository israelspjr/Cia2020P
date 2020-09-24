<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$LocalAulaProfessor = new LocalAulaProfessor();

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	
	
	$idLocalAulaProfessor = $_REQUEST['id'];
	$LocalAulaProfessor->setIdLocalAulaProfessor($idLocalAulaProfessor);
	$LocalAulaProfessor->deleteLocalAulaProfessor();
	
}else{
	
	$idLocalAulaProfessor = $_REQUEST['id'];
	$idProfessor = $_SESSION['idProfessor_SS'];
	$idZonaAtendimentoCidade = $_REQUEST['idZonaAtendimentoCidade'];
	
	$LocalAulaProfessor->setIdLocalAulaProfessor($idLocalAulaProfessor);
	$LocalAulaProfessor->setProfessorIdProfessor($idProfessor);
	$LocalAulaProfessor->setZonaAtendimentoCidadeIdZonaAtendimentoCidade($idZonaAtendimentoCidade);
	
	if($idLocalAulaProfessor != "" && $idLocalAulaProfessor > 0 ){
		$LocalAulaProfessor->updateLocalAulaProfessor();
		$arrayRetorno['mensagem'] = "Cadastro atualizado com sucesso";
		
	}else{
		$idLocalAulaProfessor = $LocalAulaProfessor->addLocalAulaProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
		
		
		if($_POST['pais_idPais'] == ID_PAIS){
			$acaoVolta = "zonaCidade";
		}else{
			$acaoVolta = "zonaPais";
		}

		$arrayRetorno['pagina'] = "/cursos/portais/modulos/cadastro/formacaoPerfil.php";
		$arrayRetorno['ondeAtualizar'] = "#centro";
		
	}
			
}

echo json_encode($arrayRetorno);

?>