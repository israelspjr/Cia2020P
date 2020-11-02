<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ComoConheceu = new ComoConheceu();

$idComoConheceu = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ComoConheceu->setIdComoConheceu($idComoConheceu);	
	$ComoConheceu->updateFieldComoConheceu("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$comoConheceu = $_POST['comoConheceu'];
	$comoConheceuF = $_POST['comoConheceuF'];
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	if ($comoConheceuF == 1) {
		$aluno = 1; // ( $_POST['aluno'] == "1" ? 1 : 0);
		$professor = 0;
		$geral = 0;	
	} elseif ($comoConheceuF == 2) {
		$professor = 1;
		$aluno = 0;
		$geral = 0;	
	} else {
		$geral = 1;	
		$professor = 0;
		$aluno = 0;	
	}
	
	$ComoConheceu->setIdComoConheceu($idComoConheceu);
	$ComoConheceu->setComoConheceu($comoConheceu);
	$ComoConheceu->setInativo($inativo);
	$ComoConheceu->setAluno($aluno);
	$ComoConheceu->setProfessor($professor);
	$ComoConheceu->setGeral($geral);
	
	if($idComoConheceu != "" && $idComoConheceu > 0 ){
		$ComoConheceu->updateComoConheceu();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idComoConheceu = $ComoConheceu->addComoConheceu();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>