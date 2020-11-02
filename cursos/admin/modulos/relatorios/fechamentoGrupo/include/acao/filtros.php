<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$GerenteTem = new GerenteTem();

$where = "WHERE 1 ";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

$idIdioma = implode(",",$_POST['idIdioma']);
if($idIdioma) $where .= " AND I.idIdioma IN(".$idIdioma.")";

$idGrupo = $_POST['grupo_idGrupo'];
if($idGrupo > 0) $where .= " AND G.idGrupo IN(".$idGrupo.")";

$filtroTipo = implode(",",$_POST['filtroTipo']); 
if($filtroTipo) $where .= " AND FG.tipo IN(".$filtroTipo.")";

$idClientePj = $_POST['clientePj_idClientePj'];
if($idClientePj > 0) $where .= " AND PR.clientePj_idClientePj IN(".$idClientePj.")";

$idGerente = implode(",",$_POST['idGerente']);

if ($idGerente != "-") {
if($idGerente) {

$IdClientePjs = $GerenteTem->selectGerenteTem(" Where gerente_idGerente in(".$idGerente.") AND dataExclusao is null");

//Uteis::pr($IdClientePjs);	

foreach ($IdClientePjs as $valor) {
	if ($valor['clientePj_idClientePj'] > 0) {
	
$id2[] = $valor['clientePj_idClientePj'];	
	}
	
}
$id2 = implode(",",$id2);
	$where .= " AND PR.clientePj_idClientePj IN(".$id2.")";
	
}
}

$ano_ini = $_POST['ano'];
$mes_ini = $_POST['mes'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}

$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}

$data1 = $ano_ini."-".$mes_ini."-01";

//$data1 = $data1." 00:00:00";

$dataX = $ano_fim."-".$mes_fim."-01 00:00:00";

$dataX = date("Y-m-d", strtotime("-1 days", strtotime("+1 months", strtotime($dataX))));

$dataX = $dataX." 00:00:00";

$where .= " AND FG.dataFechamento between '".$data1."' AND '".$dataX."'";

//echo $where;
?>
