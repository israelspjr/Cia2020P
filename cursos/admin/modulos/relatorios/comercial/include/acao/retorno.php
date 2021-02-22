<?php  
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$IntegranteGrupo = new IntegranteGrupo();

$arrayRetorno = array();


//FILTROS
$where = "";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
/*
$status = $_POST['status'];

if( $status != '' ) {
	if ($status == 2) {
		$where .= " AND PF.excluido = 1";
	} else {
		$where .= " AND PF.excluido = 0 AND PF.inativo =".$status;
	}
}
/*

$grupo1 = implode(",", $_POST['grupo1']);


$tipoCliente_idTipoCliente = implode(",",$_POST['TipoCliente_idTipoCliente']);
if( $tipoCliente_idTipoCliente ) $where .= " AND PF.tipoCliente_idTipoCliente IN(".$tipoCliente_idTipoCliente.")";
*/
$nome = $_POST['nome'];
if( $nome != '' ):
   $where .= " AND CPF.nome like '%".$nome."%'";
endif;    


$IdClientePj = $_POST['clientePj_idClientePj'];
$area = $_POST['area'];
$where .= " AND CPF.area = ".$area;

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
$dataInicio = $anoIni."-".$mes_ini."-01";
$dataFim = $anoFim."-".$mes_fim."-01";

$dataReferenciaFinal = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataFim))));

$where .= " AND (".$valorCriterio." between '".$dataInicio ."' AND '".$dataReferenciaFinal."' )";


//	}
}
//echo $where;
//if($IdClientePj != "-"){
//if($IdClientePj!= "") $where .= " AND PF.clientePj_idClientePj = ".$IdClientePj; 
//}

$idIdioma = $_REQUEST['idIdioma'];
if($idIdioma != "-"){
	if($idIdioma != "") {
		$where .= " AND PR.idioma_idIdioma = ".$idIdioma;
	}
}

$IdNivelEstudo = $_REQUEST['IdNivelEstudo'];
if($IdNivelEstudo != "-"){
	if($IdNivelEstudo != "") {
		$where .= " AND PAG.nivelEstudo_IdNivelEstudo = ".$IdNivelEstudo;
	}
}

$where .= " ORDER BY dataRetorno ";
/*
$grupo_idGrupo = $_POST['grupo_idGrupo'];
if($grupo_idGrupo != "-"){
if($grupo_idGrupo!= "") $idGrupo = $grupo_idGrupo; 
}


$pendentes = $_POST['pendentes'];
if ($pendentes == 'on') {
	$pendentes = 1;
}
*/
//echo $where;

$arrayRetorno['excel'] = $IntegranteGrupo->selectIntegranteGrupoTr_historicoInd($where,0, $IdClientePj,1,$dataFim, 1, $campos, $camposNome);

echo json_encode($arrayRetorno);

?>

