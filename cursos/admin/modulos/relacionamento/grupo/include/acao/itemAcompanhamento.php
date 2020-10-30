<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AcompanhamentoCurso.class.php");

	
$AcompanhamentoCurso = new AcompanhamentoCurso();	

$idAcompanhamentoCurso = $_REQUEST['id'];
$idPlanoAcaoGrupo = $_REQUEST['idPlanoAcaoGrupo'];
$idProfessor = $_REQUEST['idProfessor'];
$idPeriodoAcompanhamentoCurso = $_REQUEST['idPeriodoAcompanhamentoCurso'];

if($_REQUEST['acao']=="gravaObs"){
	$AcompanhamentoCurso->setIdAcompanhamentoCurso($idAcompanhamentoCurso);
	$AcompanhamentoCurso->updateFieldAcompanhamentoCurso("obs", $_POST['obs']);
	
	$arrayRetorno['mensagem'] = "Observação cadastrada com sucesso";
}
echo json_encode($arrayRetorno);
?>