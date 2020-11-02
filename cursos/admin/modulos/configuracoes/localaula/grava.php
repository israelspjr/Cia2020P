<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/LocalAula.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$LocalAula = new LocalAula();
	

$idLocalAula = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$LocalAula->setIdLocalAula($idLocalAula);	
	$LocalAula->updateFieldLocalAula("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$local = $_POST['local'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$LocalAula->setIdLocalAula($idLocalAula);
	$LocalAula->setLocal($local);
	$LocalAula->setInativo($inativo);
	
	
	
	if($idLocalAula != "" && $idLocalAula > 0 ){
		$LocalAula->updateLocalAula();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idLocalAula = $LocalAula->addLocalAula();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>