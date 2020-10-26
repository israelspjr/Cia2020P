<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$DisponibilidadeProfessor = new DisponibilidadeProfessor();

//$idDisponibilidadeProfessor = $_REQUEST['id'];

$idProfessor = $_REQUEST['id'];

//$DisponibilidadeProfessor->setIdDisponibilidade($idDisponibilidadeProfessor);

$arrayRetorno = array();

if($_REQUEST['acao']=="deletar"){
		
	$DisponibilidadeProfessor->deleteDisponibilidadeProfessorTotal($id);
	
	$arrayRetorno['mensagem'] = MSG_CADDEL;
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);

?>
