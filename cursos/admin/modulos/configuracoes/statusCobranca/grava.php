<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/StatusCobranca.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$StatusCobranca = new StatusCobranca();
	
$idStatusCobranca = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
			
	$StatusCobranca->setIdStatusCobranca($idStatusCobranca);	
	$StatusCobranca->updateFieldStatusCobranca("excluido", "1");	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$inativo = ($_POST['inativo'] == "1") ? "1" : "0" ;
			
	$StatusCobranca->setIdStatusCobranca($idStatusCobranca);
	$StatusCobranca->setStatus($_POST['status']);
	$StatusCobranca->setCor($_POST['cor']);
	$StatusCobranca->setInativo($inativo);
	
	if($idStatusCobranca != "" && $idStatusCobranca > 0 ){
		$StatusCobranca->updateStatusCobranca();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idStatusCobranca = $StatusCobranca->addStatusCobranca();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>