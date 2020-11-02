<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];
$where1 = " WHERE 1 ";
$where2 = " WHERE 1 ";


if($mes && $ano) {
    $where1 .= " AND D.mes = $mes AND D.ano = $ano ";
    $where2 .= " AND MONTH(previsaoReajuste) = $mes AND YEAR(previsaoReajuste) = $ano ";
}

$clientePj_idClientePj = $_REQUEST['clientePj_idClientePj'];
if($clientePj_idClientePj != "-"){
if($clientePj_idClientePj){
     $where2 .= " AND GPJ.clientePj_idClientePj = ".$clientePj_idClientePj;
     $where1 .= " AND CPJ.idClientePj = ".$clientePj_idClientePj;
}
}

$idGrupo = $_REQUEST['grupo_idGrupo'];
if($idGrupo != "-"){
if($idGrupo){
     $where1 .= " AND G.idGrupo =".$idGrupo; 
     $where2 .= " AND G.idGrupo =".$idGrupo;
}
}

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
if($IdGerente!= ""){
     $where1 .= " AND GER.gerente_idGerente in (".$IdGerente.")";
     $where2 .= " AND GER.gerente_idGerente in (".$IdGerente.")"; 
}
}

