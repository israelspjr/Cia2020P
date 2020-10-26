<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/GerenteTem.class.php");


$GerenteTem = new GerenteTem();
$arrayRetorno = array();
	
$idGerenteTem = $_REQUEST['id'];

$GerenteTem->setIdGgerenteTem($idGerenteTem);		
//print_r($_POST); exit;

if($_POST['acao'] == 'deletar'){
	
	$GerenteTem->updateFieldGerenteTem('dataExclusao', date('Y-m-d H:i:s'));	 
	$arrayRetorno['mensagem'] = "Saida do gerete definida com sucesso.";
	
}else{

	$GerenteTem->setGerenteIdGerente($_POST['idGerente']);
	$GerenteTem->setClientePjIdClientePj($_POST['clientePj_idClientePj']);
	$GerenteTem->setGrupoIdGrupo($_POST['idGrupo']);	
	
	
	$idGerenteTem = $GerenteTem->addGerenteTem();
	
	$arrayRetorno['mensagem'] = MSG_CADNEW;
	$arrayRetorno['fecharNivel'] = true;
}

echo json_encode($arrayRetorno);

?>