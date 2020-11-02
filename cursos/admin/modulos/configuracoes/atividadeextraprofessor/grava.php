<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$AtividadeExtraProfessor = new AtividadeExtraProfessor();	

$idAtividadeExtraProfessor = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
			
	$AtividadeExtraProfessor->setIdAtividadeExtraProfessor($idAtividadeExtraProfessor);	
	$AtividadeExtraProfessor->updateFieldAtividadeExtraProfessor("excluido", "1");	
		
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$idTipoAtividadeExtraProfessor = $_POST['idTipoAtividadeExtraProfessor'];
	$nome = $_POST['nome'];
	$ativar = ($_POST['ativar'] == "1" ? 1 : 0);
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$AtividadeExtraProfessor->setIdAtividadeExtraProfessor($idAtividadeExtraProfessor);
	$AtividadeExtraProfessor->setTipoAtividadeExtraProfessorIdTipoAtividadeExtraProfessor($idTipoAtividadeExtraProfessor);
	$AtividadeExtraProfessor->setNome($nome);
    $AtividadeExtraProfessor->setAtivar($ativar);
	$AtividadeExtraProfessor->setInativo($inativo);
	
	if($idAtividadeExtraProfessor != "" && $idAtividadeExtraProfessor > 0 ){
		$AtividadeExtraProfessor->updateAtividadeExtraProfessor();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idAtividadeExtraProfessor = $AtividadeExtraProfessor->addAtividadeExtraProfessor();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>