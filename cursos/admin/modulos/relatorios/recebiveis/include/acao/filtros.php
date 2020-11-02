<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$tipo = $_POST['tipoRel'];

$where = " WHERE 1 ";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];
	
$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$mesF = $_REQUEST['mesF'];
$anoF = $_REQUEST['anoF'];
$where .= " AND ((D.mes between $mes AND $mesF) AND (D.ano between $ano AND $anoF))";



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
if($IdGerente!= "") $where .= " AND GER.gerente_idGerente in (".$IdGerente.") AND GER.dataExclusao is null"; 
}
//echo $where;
?>
