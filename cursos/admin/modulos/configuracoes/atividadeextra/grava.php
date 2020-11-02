<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/AtividadeExtra.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");


$AtividadeExtra = new AtividadeExtra();
	

$idAtividadeExtra = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$AtividadeExtra->setIdAtividadeExtra($idAtividadeExtra);	
	$AtividadeExtra->updateFieldAtividadeExtra("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$idTipoAtividadeExtra = $_POST['idTipoAtividadeExtra'];
	$nome = $_POST['nome'];
	$ativar = ($_POST['ativar'] == "1" ? 1 : 0);
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$AtividadeExtra->setIdAtividadeExtra($idAtividadeExtra);
	$AtividadeExtra->setTipoAtividadeExtraIdTipoAtividadeExtra($idTipoAtividadeExtra);
	$AtividadeExtra->setNome($nome);
    $AtividadeExtra->setAtivar($ativar);
	$AtividadeExtra->setInativo($inativo);
	
	if($idAtividadeExtra != "" && $idAtividadeExtra > 0 ){
		$AtividadeExtra->updateAtividadeExtra();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idAtividadeExtra = $AtividadeExtra->addAtividadeExtra();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>