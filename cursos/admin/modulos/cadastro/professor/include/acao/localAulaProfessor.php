<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/LocalAulaProfessor.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$LocalAulaProfessor = new LocalAulaProfessor();
$ZonaAtendimentoCidade = new ZonaAtendimentoCidade();


$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
	$arrayRetorno['mensagem'] = "Local de aula do professor deletado com sucesso";
	
	
	$idLocalAulaProfessor = $_REQUEST['id'];
	$LocalAulaProfessor->setIdLocalAulaProfessor($idLocalAulaProfessor);
	$LocalAulaProfessor->deleteLocalAulaProfessor();
	
}else{
	
	$idLocalAulaProfessor = $_REQUEST['id'];
	$idProfessor = $_REQUEST['idProfessor'];
	$idZonaAtendimentoCidade = $_REQUEST['idZonaAtendimentoCidade'];
	$idCidade = $_REQUEST['idCidade'];
	$idPais = $_REQUEST['pais_idPais'];
	
	if ($idZonaAtendimentoCidade == "-") {
	$ZonaAtendimentoCidade->setCidadeIdCidade($idCidade);
	$ZonaAtendimentoCidade->setPaisIdPais($idPais);
	$ZonaAtendimentoCidade->setZona("Todas");
		$idZonaAtendimentoCidade = $ZonaAtendimentoCidade->addZonaAtendimentoCidade();
	}
	
	$LocalAulaProfessor->setIdLocalAulaProfessor($idLocalAulaProfessor);
	$LocalAulaProfessor->setProfessorIdProfessor($idProfessor);
	$LocalAulaProfessor->setZonaAtendimentoCidadeIdZonaAtendimentoCidade($idZonaAtendimentoCidade);
	
	if($idLocalAulaProfessor != "" && $idLocalAulaProfessor > 0 ){
		$LocalAulaProfessor->updateLocalAulaProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
		
	}else{
		$idLocalAulaProfessor = $LocalAulaProfessor->addLocalAulaProfessor();
		$arrayRetorno['mensagem'] = "Local de aula do professor adicionado com sucesso";
		
		
		if($_POST['pais_idPais'] == ID_PAIS){
			$acaoVolta = "zonaCidade";
		}else{
			$acaoVolta = "zonaPais";
		}

		$arrayRetorno['pagina'] = CAMINHO_CAD."endereco/include/acao/endereco.php?acao=".$acaoVolta."&idProfessor=".$idProfessor."&idCidade=".$_POST['idCidade']."&idPais=".$_POST['pais_idPais'];
		$arrayRetorno['ondeAtualizar'] = "#div-zona";
		
	}
			
}

echo json_encode($arrayRetorno);

?>