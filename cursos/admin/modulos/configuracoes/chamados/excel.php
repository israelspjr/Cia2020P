<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$Chamados = new Chamados();

$anoIni = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}
$anoFim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}

if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
$mesIni = $ano_ini."-".$mes_ini."-01 00:00:00";
$mesFim = $ano_fim."-".$mes_fim."-30 00:00:00";

}

$status =  $_POST['status'];
if( $status != '' ) {
	
	if ($status == 0) {
	
	$where .= "where T.finalizado IS NULL";
	$where .= " AND (T.dataSolicitacao between '".$mesIni."' and '".$mesFim."')";
	
	} elseif ($status == 1) {
	
	$where .= "where T.finalizado = 1";
	$where .= " AND (T.dataSolucao between '".$mesIni."' and '".$mesFim."')";
	} else {
		$where .= "where 1";
	}
}

$idFuncionario = $_REQUEST['idFuncionario'];
if($idFuncionario!='') $where .= " AND T.funcionario_idFuncionario = ".$idFuncionario;

$idSistema = $_REQUEST['sistema'];
if ($idSistema != '-') $where .= " AND sistema = ".$idSistema;
//echo $where;

$arrayRetorno = array();

//require_once "index.php";
	
$arrayRetorno['excel'] = $Chamados->selectChamadosTr($caminhoAbrir, $caminhoAtualizar, $ondeAtualiza, $where, true);

echo json_encode($arrayRetorno);
?>