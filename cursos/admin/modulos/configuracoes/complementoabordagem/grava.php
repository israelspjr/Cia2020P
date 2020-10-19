<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$ComplementoAbordagem = new ComplementoAbordagem();
	

$idComplementoAbordagem = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ComplementoAbordagem->setIdComplementoAbordagem($idComplementoAbordagem);	
	$ComplementoAbordagem->updateFieldComplementoAbordagem("excluido", "1");	
		
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$item = $_POST['item'];
	
	$padrao = $_POST['padrao'];
	$nome = $_POST['nome'];
	$portalProfessor = ( $_POST['portalProfessor'] == "1" ? 1 : 0);
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$ComplementoAbordagem->setIdComplementoAbordagem($idComplementoAbordagem);
	$ComplementoAbordagem->setItem($item);
	$ComplementoAbordagem->setInativo($inativo);
	$ComplementoAbordagem->setPadrao($padrao);
	$ComplementoAbordagem->setNome($nome);
	$ComplementoAbordagem->setPortalProfessor($portalProfessor);
	
	if($idComplementoAbordagem != "" && $idComplementoAbordagem > 0 ){
		$ComplementoAbordagem->updateComplementoAbordagem();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idComplementoAbordagem = $ComplementoAbordagem->addComplementoAbordagem();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>