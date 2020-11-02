<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$RelatorioNovo = new RelatorioNovo();
$GerenteTem = new GerenteTem();

$arrayRetorno = array();

$where = "WHERE 1 ";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

$idGrupo = $_POST['grupo_idGrupo'];
if($idGrupo > 0) $where .= " AND G.idGrupo IN(".$idGrupo.")";

$filtroTipo = $_POST['tipo']; 
if($filtroTipo != '')  $where .= " AND CDG.tipo IN(".$filtroTipo.")";

$idClientePj = $_POST['clientePj_idClientePj'];
if($idClientePj > 0) $where .= " AND CPJ.idClientePj IN(".$idClientePj.")";

$idGerente = implode(",",$_POST['idGerente']);

if ($idGerente != "-") {
if($idGerente) {

$IdClientePjs = $GerenteTem->selectGerenteTem(" Where gerente_idGerente in(".$idGerente.") AND dataExclusao is null");

foreach ($IdClientePjs as $valor) {
	if ($valor['clientePj_idClientePj'] > 0) {
	
$id2[] = $valor['clientePj_idClientePj'];	
	}
	
}
$id2 = implode(",",$id2);
	$where .= " AND CPJ.idClientePj IN(".$id2.")";
	
}
}

$ano_ini = $_POST['ano'];
$mes_ini = $_POST['mes'];

$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];

$where .= " AND ((CDG.mes >='".$mes_ini."' AND CDG.ano >= '".$ano_ini."' ) AND (CDG.mes <='".$mes_fim."' AND CDG.ano <= '".$ano_fim."' ))";


$arrayRetorno['excel'] =  $RelatorioNovo->relatorioCredDeb($where, true, $idProfessor, $campos, $camposNome);

echo json_encode($arrayRetorno);

?>

