<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoContatoProposta.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoContatoProposta = new TipoContatoProposta();
	

$idTipoContatoProposta = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoContatoProposta->setIdTipoContatoProposta($idTipoContatoProposta);	
	$TipoContatoProposta->updateFieldTipoContatoProposta("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipo = $_POST['tipo'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoContatoProposta->setIdTipoContatoProposta($idTipoContatoProposta);
	$TipoContatoProposta->setTipo($tipo);
	$TipoContatoProposta->setInativo($inativo);
	
	
	
	if($idTipoContatoProposta != "" && $idTipoContatoProposta > 0 ){
		$TipoContatoProposta->updateTipoContatoProposta();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoContatoProposta = $TipoContatoProposta->addTipoContatoProposta();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>