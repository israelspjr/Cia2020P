<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoVisita.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoVisita = new TipoVisita();
	

$idTipoVisita = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoVisita->setIdTipoVisita($idTipoVisita);	
	$TipoVisita->updateFieldTipoVisita("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipo = $_POST['tipo'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoVisita->setIdTipoVisita($idTipoVisita);
	$TipoVisita->setTipo($tipo);
	$TipoVisita->setInativo($inativo);
	
	
	
	if($idTipoVisita != "" && $idTipoVisita > 0 ){
		$TipoVisita->updateTipoVisita();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoVisita = $TipoVisita->addTipoVisita();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>