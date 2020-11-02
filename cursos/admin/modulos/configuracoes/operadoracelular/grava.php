<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/OperadoraCelular.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$OperadoraCelular = new OperadoraCelular();
	

$idOperadoraCelular = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$OperadoraCelular->setIdOperadoraCelular($idOperadoraCelular);	
	$OperadoraCelular->updateFieldOperadoraCelular("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$OperadoraCelular->setIdOperadoraCelular($idOperadoraCelular);
	$OperadoraCelular->setNome($nome);
	$OperadoraCelular->setInativo($inativo);
	
	
	
	if($idOperadoraCelular != "" && $idOperadoraCelular > 0 ){
		$OperadoraCelular->updateOperadoraCelular();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idOperadoraCelular = $OperadoraCelular->addOperadoraCelular();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>