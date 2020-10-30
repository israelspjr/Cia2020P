<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$AulaGrupoProfessor = new AulaGrupoProfessor();
$Professor = new Professor();

$dataFimTmp = $_REQUEST['dataFim'];
$dataFim = Uteis::gravarData($dataFimTmp);

$idAulaGrupoProfessor = $_GET['id'];
$arrayRetorno = array();
//if ($idAulaPermanenteGrupo) {
	
//	$valorAulaGrupo = $AulaGrupoProfessor -> selectAulaGrupoProfessor(' WHERE aulaPermanenteGrupo_idAulaPermanenteGrupo =' . $idAulaPermanenteGrupo);
//	$idAulaGrupoProfessor = $valorAulaGrupo[0]['idAulaGrupoProfessor'];
	
	$AulaGrupoProfessor->setIdAulaGrupoProfessor($idAulaGrupoProfessor);
	$AulaGrupoProfessor->updateFieldAulaGrupoProfessor('dataFim',$dataFim);
	
	$arrayRetorno['mensagem'] = MSG_CADATU;
	$arrayRetorno['fecharNivel'] = true;
	
	
	echo json_encode($arrayRetorno);
//	Uteis::pr($valorAulaGrupo);

//	$Nome = $Professor->getNome($idProfessor);
//	$dataFim = Uteis::exibirData($valorAulaGrupo[0]['dataFim']);

//}


?>
