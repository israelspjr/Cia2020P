<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Gerente.class.php");


$Gerente = new Gerente();
$arrayRetorno = array();
	
$idGerente = $_GET['id'];

$inativo = ( $_POST['inativo'] == "1" ? 1 : 0);
	
$Gerente->setIdGerente($idGerente);		
$Gerente->setFuncionarioIdFuncionario($_POST['idFuncionario']);
$Gerente->setCor($_POST['color']);

$Gerente->setInativo($_POST['inativo']);
$Gerente->setObs($_POST['obs']);

//print_r($_POST); exit; 

if($idGerente != "" && $idGerente > 0 ){
	$Gerente->updateGerente();
	$arrayRetorno['mensagem'] = MSG_CADATU;
}else{
	$idGerente = $Gerente->addGerente();
	$arrayRetorno['mensagem'] = MSG_CADNEW;
	$arrayRetorno['atualizarNivelAtual'] = true;
	$arrayRetorno['pagina'] = CAMINHO_CAD."gerente/cadastro.php?id=".$idGerente;
}

echo json_encode($arrayRetorno);

?>