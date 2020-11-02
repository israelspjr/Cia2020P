<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$IntegranteGrupo = new IntegranteGrupo();

$arrayRetorno = array();


//FILTROS
$where = "";

$nome = $_POST['nome'];
if( $nome != '' ):
   $where .= " AND CPF.nome like '%".$nome."%'";
endif;    


$IdClientePj = $_POST['clientePj_idClientePj'];

$criterio = $_POST['dataRS'];
//if ($criterio != '') {
	if ($criterio == 1) {
		$valorCriterio = "P.dataRetorno";
	} else {
		$valorCriterio = "P.dataSaida";
	}
//}
//echo $nome."nome";
if ($nome == '') {
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

//if( $mes_ini && $ano_ini && $mes_fim && $ano_fim ){
$dataInicio = $ano_ini."-".$mes_ini."-01";
$dataFim = $ano_fim."-".$mes_fim."-01";

$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataFim))));

$where .= " AND (".$valorCriterio." between '".$dataInicio ."' AND '".$dataReferenciaFinal."' )";

$where .= " ORDER BY dataRetorno ";
}

$arrayRetorno['excel'] = $IntegranteGrupo->selectIntegranteGrupoTr_historicoInd($where,0, $IdClientePj,1);

echo json_encode($arrayRetorno);

?>

