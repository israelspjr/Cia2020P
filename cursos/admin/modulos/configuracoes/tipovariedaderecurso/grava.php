<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/TipoVariedadeRecurso.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$TipoVariedadeRecurso = new TipoVariedadeRecurso();
	

$idTipoVariedadeRecurso = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$TipoVariedadeRecurso->setIdTipoVariedadeRecurso($idTipoVariedadeRecurso);	
	$TipoVariedadeRecurso->updateFieldTipoVariedadeRecurso("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$tipo = $_POST['tipo'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$TipoVariedadeRecurso->setIdTipoVariedadeRecurso($idTipoVariedadeRecurso);
	$TipoVariedadeRecurso->setTipo($tipo);
	$TipoVariedadeRecurso->setInativo($inativo);
	
	
	
	if($idTipoVariedadeRecurso != "" && $idTipoVariedadeRecurso > 0 ){
		$TipoVariedadeRecurso->updateTipoVariedadeRecurso();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idTipoVariedadeRecurso = $TipoVariedadeRecurso->addTipoVariedadeRecurso();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>