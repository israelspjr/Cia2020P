<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/cursos/config/admin.php");

$idSegmento = $_REQUEST['id'];

$arrayRetorno = array();
$EmailsMkt = new EmailsMkt();
$Segmento = new Segmento();
$Funcionario = new Funcionario();

$EmailsMkt->setSegmentoIdSegmento($idSegmento);


	if($_POST['acao'] == 'deletar'){
		
//		$valorEmailsMkt = $EmailsMkt->selectEmailsMkt(" WHERE idEmailsMkt = ".$idEmailsMkt);
		$EmailsMkt->deleteEmailsMktSegmento();
		$arrayRetorno['mensagem'] = MSG_CADDEL;
		
		
		
	}