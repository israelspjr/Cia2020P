<?php
//pagina conteudo a pagina de gravação

require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/KitMaterialDidatico.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$KitMaterialDidatico = new KitMaterialDidatico();
	

$idKitMaterialDidatico = $_REQUEST['id'];

$arrayRetorno = array();

if($_POST['acao']=="deletar"){
	
		
	$KitMaterialDidatico->setIdKitMaterialDidatico($idKitMaterialDidatico);	
	$KitMaterialDidatico->updateFieldKitMaterialDidatico("excluido", "1");	
	
	
	$arrayRetorno['mensagem'] = "Cadastro arquivado com sucesso.<br /><small>Por questões de segurança o cadastro não pode ser totalmente excluído, ele será arquivado.</small>";
		
}else{
	 
	$kitMaterial_idKitMaterial = $_POST['idKitMaterial'];
	$materialDidatico_idMaterialDidatico = $_POST['idMaterialDidatico'];
	
	
	$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
	$KitMaterialDidatico->setIdKitMaterialDidatico($idKitMaterialDidatico);
	$KitMaterialDidatico->setKitMaterialIdKitMaterial($kitMaterial_idKitMaterial);
	$KitMaterialDidatico->setMaterialDidaticoIdMaterialDidatico($materialDidatico_idMaterialDidatico);
	
	
	
	if($idKitMaterialDidatico != "" && $idKitMaterialDidatico > 0 ){
		$KitMaterialDidatico->updateKitMaterialDidatico();
		$arrayRetorno['mensagem'] = MSG_CADATU;
	}else{
		$idKitMaterialDidatico = $KitMaterialDidatico->addKitMaterialDidatico();
		$arrayRetorno['mensagem'] = MSG_CADNEW;
	}
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);
?>