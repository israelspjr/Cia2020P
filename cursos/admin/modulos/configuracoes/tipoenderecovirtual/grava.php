<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoEnderecoVirtual.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoEnderecoVirtual = new TipoEnderecoVirtual();
	

$idTipoEnderecoVirtual = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoEnderecoVirtual->setIdTipoEnderecoVirtual($idTipoEnderecoVirtual);	
	$TipoEnderecoVirtual->updateFieldTipoEnderecoVirtual("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipo = $_POST['tipo'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoEnderecoVirtual->setIdTipoEnderecoVirtual($idTipoEnderecoVirtual);
	$TipoEnderecoVirtual->setTipo($tipo);
	$TipoEnderecoVirtual->setInativo($inativo);
	
	
	
	if($idTipoEnderecoVirtual != "" && $idTipoEnderecoVirtual > 0 ){
		$TipoEnderecoVirtual->updateTipoEnderecoVirtual();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoEnderecoVirtual = $TipoEnderecoVirtual->addTipoEnderecoVirtual();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>