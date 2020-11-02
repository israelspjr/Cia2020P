<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");
$IntengranteGrupo = new IntegranteGrupo();


$tipo = $_POST['tipoRel'];
$tipoR = $_POST['tipoR'];
$alunoN = $_POST['alunosN'];
$idgerente = $_POST['idGerente'];
$status = $_POST['statusG'];
$statusG = $_POST['statusG'];

if ($status != "-") {
	$and .= " AND G.inativo = ".$status;
}

if ($idgerente != '') {
	if ($idgerente[0] != '-') {
$ids = "(";
foreach ($idgerente as $valor) {
	$ids .= $valor.",";
	
	}
	$ids .= "0)";
	$gerente = " INNER JOIN gerenteTem AS GT on GT.clientepj_idClientePj = PJ.idClientepj WHERE GT.gerente_idGerente in ".$ids." AND GT.dataExclusao IS NULL";
}
} 
if ($ids == '') {
	$gerente = " WHERE 1";
}
$where = $gerente. $and."  AND BH.credDeb is null ";
	
$alunoS = $_REQUEST['statusA'];
if ($alunoS != '') {
	if ($alunoS != '-') {
		$where .= " AND CPF.inativo = ".$alunoS;	
	}
	
}
	
		
	
	
$idGrupo = $_REQUEST['grupo_idGrupo'];
$idGrupos = $_REQUEST['grupo_idGrupo'];
if ($idGrupo != "-") {
if ($idGrupo) $where .= " AND G.idGrupo IN (".$idGrupo.")";	
}

$clientePj_idClientePj = $_REQUEST['clientePj_idClientePj'];
if ($clientePj_idClientePj != "-") {
if($clientePj_idClientePj) $where .= " AND GPJ.clientePj_idClientePj IN (".$clientePj_idClientePj.")";	
}

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if($mes_ini<10):
$d1 = "01-0".$mes_ini."-".$ano_ini;
$dataIni = $ano_ini.="-"."0".$mes_ini."-01";
else: 
$d1 = "01-".$mes_ini."-".$ano_ini;
$dataIni = $ano_ini.="-".$mes_ini."-01";
endif;    

//$data_ini = new DateTime($d1);
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];

if($mes_fim<10):
$d2 = "01-0".$mes_fim."-".$ano_fim;
$dataFim = $ano_fim.="-"."0".$mes_fim."-01";
else:
$d2 = "01-".$mes_fim."-".$ano_fim;
$dataFim = $ano_fim.="-".$mes_fim."-01";
endif;

//$data_fim = new DateTime($d2);

//$dInicial = $data_ini->format('Y-m-d');
//$dFinal = $data_fim->format('Y-m-d');

if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
	$where .= " AND FF.dataReferencia >= '$dataIni'"; //{$data_ini->format('Y-m-d')}' 
	$where .= " AND FF.dataReferencia <= '$dataFim'"; //{$data_fim->format('Y-m-d')}' ";
	$d1 = $dataIni;
	$d2 = $dataFim;
}

$idIntegranteGrupo = $_REQUEST['idIntegranteGrupo'];
if($idIntegranteGrupo) {
	$valor = $IntengranteGrupo->selectIntegranteGrupo(" WHERE idIntegranteGrupo = ".$idIntegranteGrupo);
	$idClientePf = $valor[0]['clientePf_idClientePf'];

	$where .= " AND CPF.idClientePf IN (".$idClientePf.")";	
}

$idClientePf = $_REQUEST['idClientePf'];
if ($idClientePf != "-") {
	if ($idClientePf) $where .= " AND CPF.idClientePf IN (".$idClientePf.")";	
}

$frequencia = $_REQUEST['frequencia'];

$FME = substr($_REQUEST['FME'], 0, 3);

$where .= " AND (IG.dataSaida is null or IG.dataSaida >= '$dataIni')"; //{$data_ini->format('Y-m-d')}' )";

//$freqReal = $_REQUEST['FreqReal'];

//echo $freqReal;

//echo $where;

?>
