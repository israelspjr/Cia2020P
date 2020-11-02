<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$TipoAtividadeExtraProfessor = new TipoAtividadeExtraProfessor();

$idTipoAtividadeExtraProfessor = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoAtividadeExtraProfessor->setIdTipoAtividadeExtraProfessor($idTipoAtividadeExtraProfessor);	
	$TipoAtividadeExtraProfessor->updateFieldTipoAtividadeExtraProfessor("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoAtividadeExtraProfessor->setIdTipoAtividadeExtraProfessor($idTipoAtividadeExtraProfessor);
	$TipoAtividadeExtraProfessor->setNome($nome);
	$TipoAtividadeExtraProfessor->setInativo($inativo);
	
	
	
	if($idTipoAtividadeExtraProfessor != "" && $idTipoAtividadeExtraProfessor > 0 ){
		$TipoAtividadeExtraProfessor->updateTipoAtividadeExtraProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoAtividadeExtraProfessor = $TipoAtividadeExtraProfessor->addTipoAtividadeExtraProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>