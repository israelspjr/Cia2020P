<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$BuscaAvulsa = new BuscaAvulsa();

$arrayRetorno = array();


//FILTROS
$where = "";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
/*
$nome = $_POST['nome'];
if( $nome != '' ):
   $where .= " AND CPF.nome like '%".$nome."%'";
endif;    
*/

$IdClientePj = $_POST['clientePj_idClientePj'];
if ($IdClientePj != '') {
	if ($IdClientePj != '-') {
		$where .= " AND clientePj_idClientePj = ".$IdClientePj;	
	}
}

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
$dataInicio = $anoIni."-".$mes_ini."-01";
$dataFim = $anoFim."-".$mes_fim."-01";

$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataFim))));

$where .= " AND ( dataApartir between '".$dataInicio ."' AND '".$dataReferenciaFinal."' )";


$arrayRetorno['excel'] = $BuscaAvulsa->selectRelatorioBuscaAvulsaTr($where,false, $vBusca,$campos, $camposNome, true);

echo json_encode($arrayRetorno);

?>

