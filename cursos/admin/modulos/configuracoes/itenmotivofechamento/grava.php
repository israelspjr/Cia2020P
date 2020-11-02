<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/ItenMotivoFechamento.class.php");
 
$ItenMotivoFechamento = new ItenMotivoFechamento();
	

$idItenMotivoFechamento = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$ItenMotivoFechamento->setIdItenMotivoFechamento($idItenMotivoFechamento);	
	$ItenMotivoFechamento->updateFieldItenMotivoFechamento("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$iten = $_POST['iten'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$ItenMotivoFechamento->setIdItenMotivoFechamento($idItenMotivoFechamento);
	$ItenMotivoFechamento->setIten($iten);
	$ItenMotivoFechamento->setInativo($inativo);
	
	
	
	if($idItenMotivoFechamento != "" && $idItenMotivoFechamento > 0 ){
		$ItenMotivoFechamento->updateItenMotivoFechamento();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idItenMotivoFechamento = $ItenMotivoFechamento->addItenMotivoFechamento();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>