<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/portais.php");

$DisponibilidadeProfessor = new DisponibilidadeProfessor();

//$idDisponibilidadeProfessor = $_REQUEST['id'];

$idProfessor = $_REQUEST['id'];
$idDiaSemana = $_REQUEST['diaSemana'];

//$DisponibilidadeProfessor->setIdDisponibilidade($idDisponibilidadeProfessor);

$arrayRetorno = array();

if($_REQUEST['acao']=="deletar"){
		
	$and = " AND diaSemana = ".$idDiaSemana;	
//	echo $and;
		
	$DisponibilidadeProfessor->deleteDisponibilidadeProfessorTotal($idProfessor, $and);
	
	$arrayRetorno['mensagem'] = MSG_CADDEL;
//	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);

?>
