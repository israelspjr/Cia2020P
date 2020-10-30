<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AcompanhamentoCurso.class.php");


$AcompanhamentoCurso = new AcompanhamentoCurso();

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
	$idAcompanhamentoCurso = $_REQUEST['id'];
	
	$AcompanhamentoCurso->setIdAcompanhamentoCurso($idAcompanhamentoCurso);
	$AcompanhamentoCurso->updateFieldAcompanhamentoCurso("arquivado", "1");
	
	$arrayRetorno['mensagem'] = "Acompanhamento arquivado com sucesso";

	echo json_encode($arrayRetorno);
	
}
?>