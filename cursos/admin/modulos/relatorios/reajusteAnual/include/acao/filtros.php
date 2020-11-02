<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");

$mes = $_REQUEST['mes'];
$ano = $_REQUEST['ano'];

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];

if($mes && $ano) $where .= " AND MONTH(previsaoReajuste) = $mes AND YEAR(previsaoReajuste) = $ano ";

$clientePj_idClientePj = $_REQUEST['clientePj_idClientePj'];
if($clientePj_idClientePj != "-"){
if($clientePj_idClientePj) $where .= " AND GPJ.clientePj_idClientePj = ".$clientePj_idClientePj;
}

$idGrupo = $_REQUEST['grupo_idGrupo'];
if($idGrupo != "-"){
if($idGrupo) $where .= " AND G.idGrupo =".$idGrupo; 
}

$IdGerente = implode(",", $_POST['idGerente']);
if($IdGerente != "-"){
if($IdGerente!= "") $where .= " AND GER.gerente_idGerente in (".$IdGerente.")"; 
}
//echo $where;
?>
