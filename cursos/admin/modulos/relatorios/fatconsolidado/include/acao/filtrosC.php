<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$tipo = $_POST['tipoRel'];

//$where = "where";
	
$mes = (int)$_REQUEST['mes'];
$ano = $_REQUEST['ano'];
if($mes && $ano) $where = "where D.ano = ".$ano." AND D.mes = ".$mes;

$mes1 = $_REQUEST['mes1'];
$ano1 = $_REQUEST['ano1'];
if($mes1 && $ano1) $where1 = "where D.mes =". $mes1." AND D.ano = ".$ano1;

$clientePj_idClientePj = $_REQUEST['clientePj_idClientePj'];
if($clientePj_idClientePj != "-"){
if($clientePj_idClientePj) {
	$where .= " AND CPJ.idClientePj = ".$clientePj_idClientePj;
	$where1 .= " AND CPJ.idClientePj = ".$clientePj_idClientePj;
}
	
}

$idGrupo = $_REQUEST['grupo_idGrupo'];
if($idGrupo != "-"){
if($idGrupo) {
	$where .= " AND G.idGrupo =".$idGrupo;	
	$where1 .= " AND G.idGrupo =".$idGrupo;	
}

}

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
if($IdGerente!= "") $where .= " AND GER.gerente_idGerente in (".$IdGerente.")"; 
}
//echo $where;
?>
