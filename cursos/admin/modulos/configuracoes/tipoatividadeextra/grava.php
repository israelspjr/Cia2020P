<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoAtividadeExtra.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoAtividadeExtra = new TipoAtividadeExtra();
	

$idTipoAtividadeExtra = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoAtividadeExtra->setIdTipoAtividadeExtra($idTipoAtividadeExtra);	
	$TipoAtividadeExtra->updateFieldTipoAtividadeExtra("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoAtividadeExtra->setIdTipoAtividadeExtra($idTipoAtividadeExtra);
	$TipoAtividadeExtra->setNome($nome);
	$TipoAtividadeExtra->setInativo($inativo);
	
	
	
	if($idTipoAtividadeExtra != "" && $idTipoAtividadeExtra > 0 ){
		$TipoAtividadeExtra->updateTipoAtividadeExtra();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoAtividadeExtra = $TipoAtividadeExtra->addTipoAtividadeExtra();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>