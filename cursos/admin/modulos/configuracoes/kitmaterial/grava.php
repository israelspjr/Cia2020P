<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterial.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$KitMaterial = new KitMaterial();
	

$idKitMaterial = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$KitMaterial->setIdKitMaterial($idKitMaterial);	
	$KitMaterial->updateFieldKitMaterial("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$nome = $_POST['nome'];
	$obs = $_POST['obs'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$KitMaterial->setIdKitMaterial($idKitMaterial);
	$KitMaterial->setNome($nome);
	$KitMaterial->setObs($obs);
	$KitMaterial->setInativo($inativo);
	
	
	
	if($idKitMaterial != "" && $idKitMaterial > 0 ){
		$KitMaterial->updateKitMaterial();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idKitMaterial = $KitMaterial->addKitMaterial();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>