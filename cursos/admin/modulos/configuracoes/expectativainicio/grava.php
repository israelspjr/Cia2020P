<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ExpectativaInicio.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$ExpectativaInicio = new ExpectativaInicio();
	

$idExpectativaInicio = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ExpectativaInicio->setIdExpectativaInicio($idExpectativaInicio);	
	$ExpectativaInicio->updateFieldExpectativaInicio("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$expectativa = $_POST['expectativa'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$ExpectativaInicio->setIdExpectativaInicio($idExpectativaInicio);
	$ExpectativaInicio->setExpectativa($expectativa);
	$ExpectativaInicio->setInativo($inativo);
	
	
	
	if($idExpectativaInicio != "" && $idExpectativaInicio > 0 ){
		$ExpectativaInicio->updateExpectativaInicio();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idExpectativaInicio = $ExpectativaInicio->addExpectativaInicio();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>