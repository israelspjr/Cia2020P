<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/DemonstrativoPagamento.class.php");


$DemonstrativoPagamento = new DemonstrativoPagamento();

$arrayRetorno = array();

$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$emAberto = $_REQUEST['emAberto'];
/*
if (($_POST['emAberto'] == "") || (!isset($_POST['emAberto']))){
	$emAberto = 0;
} else {
	$emAberto = 1;
}*/


$where = " WHERE mes = $mes AND ano = $ano";

$arrayRetorno = array();

//require_once "../acao/filtros.php";
	
$arrayRetorno['excel'] = $DemonstrativoPagamento->selectDemonstrativoPagamentoTr($where, $emAberto, true);

echo json_encode($arrayRetorno);

?>