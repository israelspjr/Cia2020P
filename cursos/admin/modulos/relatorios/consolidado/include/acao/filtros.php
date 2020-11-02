<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$tipo = $_POST['tipoRel'];

$where = " WHERE 1 ";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
	
	
$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
if($mes && $ano) $where .= " AND D.mes = $mes AND D.ano = $ano ";

$clientePj_idClientePj = $_REQUEST['clientePj_idClientePj'];
if($clientePj_idClientePj != "-"){
if($clientePj_idClientePj) $where .= " AND CPJ.idClientePj = ".$clientePj_idClientePj;
}

$idGrupo = $_REQUEST['grupo_idGrupo'];
if($idGrupo != "-"){
if($idGrupo) $where .= " AND G.idGrupo =".$idGrupo;	
}

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
if($IdGerente!= "") $where .= " AND GER.gerente_idGerente in (".$IdGerente.")"; 
}

$status = $_REQUEST['statusG'];
if ($status != '-') {
if ($status == 1) {
	$where .= " AND G.inativo = 1";
} elseif ($status == 0) {
	$where .= " AND G.inativo = 0";
}
}

$where .= " AND  ((MONTH(FG.dataFechamento) !=".$mes." OR YEAR(FG.dataFechamento) != ".$ano.") OR (MONTH(FG.dataFechamento) is null) AND (YEAR(FG.dataFechamento) is null))"; 
//echo $where;
?>
