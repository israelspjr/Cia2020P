<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterialINF.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$KitMaterialINF = new KitMaterialINF();
	

$idKitMaterialINF = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$KitMaterialINF->setIdKitMaterialINF($idKitMaterialINF);	
	$KitMaterialINF->updateFieldKitMaterialINF("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	
	$kitMaterial_idKitMaterial = $_POST['idKitMaterial'];
	$relacionamentoINF_idRelacionamentoINF = $_POST['idRelacionamentoINF'];
	
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$KitMaterialINF->setIdKitMaterialINF($idKitMaterialINF);
	$KitMaterialINF->setKitMaterialIdKitMaterial($kitMaterial_idKitMaterial);
	$KitMaterialINF->setRelacionamentoINFIdRelacionamentoINF($relacionamentoINF_idRelacionamentoINF);
	$KitMaterialINF->setInativo($inativo);
	
	
	
	if($idKitMaterialINF != "" && $idKitMaterialINF > 0 ){
		$KitMaterialINF->updateKitMaterialINF();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idKitMaterialINF = $KitMaterialINF->addKitMaterialINF();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>