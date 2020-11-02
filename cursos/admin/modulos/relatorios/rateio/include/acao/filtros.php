<?php
require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/admin.php");
//require_once($_SERVER['DOCUMENT_ROOT']."/cursos/config/class/Uteis.class.php");

$where = "WHERE 1 ";

//MONTA CAMPO
$campos = $_POST['sel_lista_padrao'];
$camposNome = $_POST['sel_lista_padraoNome'];


/*
$mes = $_POST['mes'];
$ano = $_POST['ano'];
if($mes && $ano) $where .= " AND PA.mes = $mes AND PA.ano = $ano ";
*/

$ano_ini = $_POST['ano_ini'];
$mes_ini = $_POST['mes_ini'];
if ($mes_ini < 10) {
	$mes_ini = "0".$mes_ini;
}
/*
$ano_fim = $_POST['ano_fim'];
$mes_fim = $_POST['mes_fim'];
if ($mes_fim < 10) {
	$mes_fim = "0".$mes_fim;
}*/

if( $mes_ini && $ano_ini ){
$mesIni = $ano_ini."-".$mes_ini."-01";
$mesFimT = $mesIni; //$ano_fim."-".$mes_fim."-01";

$mesFim = date("Y-m-t",strtotime($mesFimT));

//$where .= " AND (PAG.dataPrevisaoTerminoEstagio between '".$mesIni."' AND '".$mesFim."')";
}

	/*	
$idProfessor = implode(",",$_POST['idProfessor']);
if($idProfessor) $where .= " AND PR.idProfessor IN(".$idProfessor.")";	 
*/
$idGrupo = $_REQUEST['grupo_idGrupo'];

if($idGrupo != "-") {
	$where .= " AND G.idGrupo IN (".$idGrupo.")";	
}
/*
$finalizadoParcial = $_POST['finalizadoParcial'];
if($finalizadoParcial!='') $where .= " AND A.finalizadoParcial = ".$finalizadoParcial;

$finalizadoGeral = $_POST['finalizadoGeral'];
if($finalizadoGeral!='') $where .= " AND A.finalizadoGeral = ".$finalizadoGeral;
*/
$idGerentes = implode(",", $_POST['idGerente']);
if($idGerentes!="-"){    
   $where .= " AND GER.gerente_idGerente in(".$idGerentes.")"; 
}

if($_POST['clientePj_idClientePj']!="" && $_POST['clientePj_idClientePj']!="-") 
        $where .= " AND GPJ.clientePj_idClientePj = ".$_POST['clientePj_idClientePj'];	

$status =  $_POST['statusG'];
if($status != "-"){
if( $status != '' ) $where .= " AND G.inativo = ".$status;
}		

//echo "//".$where;
?>
