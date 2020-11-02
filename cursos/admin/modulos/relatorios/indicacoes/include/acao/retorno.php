<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$IndicacaoClientePf = new IndicacaoClientePf();

$arrayRetorno = array();


//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

//FILTROS
$where = " where 1";

$IdClientePf = $_POST['idClientePf'];
if ($IdClientePf != '') {
	if ($IdClientePf != '-') {
	$where .= " AND  I.clientePf_idClientePf = ".$IdClientePf;	
	}
}   


$IdClientePj = $_POST['clientePj_idClientePj'];
if ($IdClientePj != '') {
	if ($IdClientePj != '-') {
	$where .= " AND  I.clientePj_idClientePj = ".$IdClientePj;	
	}
}

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


$dataInicio = $anoIni."-".$mes_ini."-01";
$dataFim = $anoFim."-".$mes_fim."-01";

$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataFim))));

$where .= " AND  (I.dataCadastro ".$valorCriterio." between '".$dataInicio ."' AND '".$dataReferenciaFinal."' )";

$where .= " ORDER BY I.dataCadastro ";

}

$arrayRetorno['excel'] = $IndicacaoClientePf->selectRelatorioIndicacaoclientepfTr($caminhoAtualizar, $ondeAtualiza, $where, $clientePj = 0, $campos, $camposNome, true);

echo json_encode($arrayRetorno);

?>

