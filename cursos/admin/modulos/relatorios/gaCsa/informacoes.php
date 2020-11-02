<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();

$arrayRetorno = array();

$where = "WHERE 1 ";

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}

if( $mes_fim && $ano_fim ){
$mesIni = $ano_ini."-".$mes_ini."-01";
$mesFim = $ano_fim."-".$mes_fim."-30";

$where .= " AND (DAF.dataAula between '".$mesIni."' AND '".$mesFim."')";
}

		
$idGrupo = $_REQUEST['grupo_idGrupo'];

if($idGrupo != "-") {
	$where .= " AND PAG.grupo_idGrupo IN (".$idGrupo.")";	
}

$idGerentes = implode(",", $_POST['idGerente']);
if($idGerentes!="-"){    
   $where .= " AND GER.gerente_idGerente in(".$idGerentes.")"; 
}

if($_POST['clientePj_idClientePj']!="" && $_POST['clientePj_idClientePj']!="-") 
        $where .= " AND GCP.clientePj_idClientePj = ".$_POST['clientePj_idClientePj'];	

$status =  $_POST['statusG'];
if($status != "-"){
if( $status != '' ) $where .= " AND G.inativo = ".$status;
}		

$idOcorrenciaFF = $_REQUEST['idOcorrenciaFF'];
if ($idOcorrenciaFF != '-') {
	if ($idOcorrenciaFF != '') {
		$ids = implode(",",$idOcorrenciaFF);
$where .= " AND DAF.ocorrenciaFF_idOcorrenciaFF in ( ".$ids.")";		
	}
}

//echo "//".$where;
	
$arrayRetorno['excel'] = $RelatorioNovo->relatorioGaCsa($where, "", true);

echo json_encode($arrayRetorno);
?>