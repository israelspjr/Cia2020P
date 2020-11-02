<?php
//pagina conteudo a pagina de gravação
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoCurso = new TipoCurso();

$idTipoCurso = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoCurso->setIdTipoCurso($idTipoCurso);	
	$TipoCurso->updateFieldTipoCurso("inativo", "1");	
	
	
//	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipo = $_POST['tipo'];
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoCurso->setIdTipoCurso($idTipoCurso);
	$TipoCurso->setNome($tipo);
	$TipoCurso->setInativo($inativo);
	
	
	
	if($idTipoCurso != "" && $idTipoCurso > 0 ){
		$TipoCurso->updateTipoCurso();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoCurso = $TipoCurso->addTipoCurso();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>