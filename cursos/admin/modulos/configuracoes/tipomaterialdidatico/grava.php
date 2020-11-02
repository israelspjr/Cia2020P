<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoMaterialDidatico.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoMaterialDidatico = new TipoMaterialDidatico();
	

$idTipoMaterialDidatico = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoMaterialDidatico->setIdTipoMaterialDidatico($idTipoMaterialDidatico);	
	$TipoMaterialDidatico->updateFieldTipoMaterialDidatico("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipo = $_POST['tipo'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoMaterialDidatico->setIdTipoMaterialDidatico($idTipoMaterialDidatico);
	$TipoMaterialDidatico->setTipo($tipo);
	$TipoMaterialDidatico->setInativo($inativo);
	
	
	
	if($idTipoMaterialDidatico != "" && $idTipoMaterialDidatico > 0 ){
		$TipoMaterialDidatico->updateTipoMaterialDidatico();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoMaterialDidatico = $TipoMaterialDidatico->addTipoMaterialDidatico();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>